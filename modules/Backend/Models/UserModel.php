<?php namespace Modules\Backend\Models;

use App\Libraries\Mongo;
use CodeIgniter\Model;
use Config\Services;
use CodeIgniter\I18n\Time;
use Modules\Backend\Config\Auth;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = '_id';
    protected $returnType = 'Modules\Auth\Entities\UserEntity';
    protected $useTimestamps = true;
    protected $allowedFields = [
        '_id', 'email', 'firstname', 'sirname', 'username', 'activate_hash', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires',
        'status', 'status_message', 'force_pass_reset', 'create_at', 'updated_at', 'deleted_at', 'groups_id'
    ];
    protected $m;

    public function __construct()
    {
        parent::__construct();
        $this->m = new Mongo();
    }

    public function findOne(array $credentials, array $select = [])
    {
        return $this->m->select($select)->where($credentials)->findOne($this->table);
    }

    public function getGroupInfos(array $credentials, array $select = [])
    {
        return $this->m->select($select)->where($credentials)->findOne('auth_groups');
    }

    public function passwordRehash(array $credentials, array $set)
    {
        return $this->m->where($credentials)->findOneAndUpdate($this->table, $set);
    }

    public function recordLoginAttempt(string $email, bool $success)
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
            'session_id' => session_id()
        ]);
    }

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

    public function purgeOldRememberTokens()
    {
        $config = new Auth();

        if (!$config->allowRemembering) {
            return;
        }
        $this->m->deleteOne('auth_tokens', ['expires <=' => date('Y-m-d H:i:s')]);
    }

    public function purgeRememberTokens(string $id)
    {
        return $this->m->deleteOne('auth_tokens', ['user_id' => $id]);
    }

    public function getRememberToken(string $selector)
    {
        return $this->m->where(['selector' => $selector])->findOne('auth_tokens');
    }

    public function updateRememberValidator(string $selector, string $validator)
    {
        return $this->m->where(['selector' => $selector])
            ->findOneAndUpdate('auth_tokens', ['hashedValidator' => hash('sha256', $validator)]);
    }

    public function logActivationAttempt(string $token = null, string $ipAddress = null, string $userAgent = null)
    {
        return $this->m->insertOne('auth_activation_attempts', [
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function logEmailActivationAttempt(string $token = null, string $ipAddress = null, string $userAgent = null)
    {
        return $this->m->insertOne('auth_email_activation_attempts', [
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function logResetAttempt(string $email, string $token = null, string $ipAddress = null, string $userAgent = null)
    {
        return $this->m->insertOne('auth_reset_password_attempts',[
            'email' => $email,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
