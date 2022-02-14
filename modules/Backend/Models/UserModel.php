<?php namespace Modules\Backend\Models;

use ci4mongodblibrary\Libraries\Mongo;
use Config\Services;
use CodeIgniter\I18n\Time;
use Modules\Backend\Config\Auth;

class UserModel
{
    /**
     * @var string
     */
    protected $table;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * @var Mongo
     */
    protected $m;

    public function __construct()
    {
        $this->m = new Mongo();
        $this->table='users';
    }

    /**
     * @param array $credentials
     * @param array $set
     * @return array|object|null
     */
    public function passwordRehash(array $credentials, array $set)
    {
        return $this->m->where($credentials)->findOneAndUpdate($this->table, $set);
    }

    /**
     * @param string $email
     * @param bool $success
     * @param int|null $falseCounter for loginAttempt false
     * @return mixed
     * @throws \Exception
     */
    public function recordLoginAttempt(string $email, bool $success, int $falseCounter = null)
    {
        $ipAddress = Services::request()->getIPAddress();
        $user_agent = Services::request()->getUserAgent();

        $agent = null;
        if ($user_agent->isBrowser())
            $agent = $user_agent->getBrowser() . ':' . $user_agent->getVersion();
        elseif ($user_agent->isMobile())
            $agent = $user_agent->getMobile();
        else
            $agent = 'nothing';

        $time = new Time('now');

        return $this->m->insertOne('auth_logins', [
            'ip_address' => $ipAddress,
            'email' => $email,
            'trydate' => $time->toDateTimeString(),
            'isSuccess' => $success,
            'user_agent' => $agent,
            'session_id' => session_id(),
            'counter' => ($success === false  ) ? $falseCounter+1 : null,
        ]);
    }

    /**
     * @return \Traversable
     */
    public function userInfos()
    {
        return $this->m->select(['email', 'firstname', 'sirname', 'username', 'status', 'status_message', 'groupName.name', 'groupName.sefLink'])
            ->aggregate($this->table, [
                '$lookup' => [
                    'from' => "auth_groups",
                    'localField' => "groups_id",
                    'foreignField' => "_id",
                    'as' => "groupName"
                ]
            ]);
    }

    /**
     * @param string $userID
     * @param string $selector
     * @param string $validator
     * @param string $expires
     * @return mixed
     * @throws \Exception
     */
    public function rememberUser(string $userID, string $selector, string $validator, string $expires)
    {
        $expires = new \DateTime($expires);

        return $this->m->insertOne('auth_tokens', [
            'user_id' => $userID,
            'selector' => $selector,
            'hashedValidator' => $validator,
            'expires' => $expires->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     *
     */
    public function purgeOldRememberTokens()
    {
        $config = new Auth();
        if (!$config->allowRemembering) return;
        $this->m->deleteOne('auth_tokens', ['expires <=' => date('Y-m-d H:i:s')]);
    }

    /**
     * @param string $selector
     * @param string $validator
     * @return array|object|null
     */
    public function updateRememberValidator(string $selector, string $validator)
    {
        return $this->m->where(['selector' => $selector])->findOneAndUpdate('auth_tokens', ['hashedValidator' => hash('sha256', $validator)]);
    }

    /**
     * used for list data with where and  where_or
     * @param string $collection
     * @param array $where
     * @param array $or
     * @param array $options
     * @param array $select
     * @return mixed
     * @throws \Exception
     *
     */
    public function getListOr(string $collection, array $where = [], array $options = [], array $select = [], array $or = [])
    {
        return $this->m->options($options)->select($select)->where($where)->where_or($or)->find($collection)->toArray();
    }

    /**
     * @param string $collection
     * @param array $where
     * @param array $options
     * @param array $or
     * @return mixed
     * @throws \Exception
     */
    public function countOr(string $collection, array $where, array $options = [], array $or = [])
    {
        return $this->m->options($options)->where($where)->where_or($or)->count($collection);
    }

    /**
     * @param string $collection
     * @param array $where
     * @param array $options
     * @param array $select
     * @param array $or
     * @return mixed
     * @throws \Exception
     */
    public function getOneOr(string $collection, array $where = [], array $options = [], array $select = [],array $or = [])
    {
        return $this->m->options($options)->select($select)->where($where)->where_or($or)->findOne($collection);
    }

    /**
     * @param string $collection
     * @param array $where
     * @param array $set
     * @param array $options
     * @return mixed
     * @throws \Exception
     */

    public function updateManyOr(string $collection, array $where, array $set, array $options = [], array $or =[])
    {
        return $this->m->options($options)->where($where)->where_or($or)->set($set)->updateMany($collection);
    }

}
