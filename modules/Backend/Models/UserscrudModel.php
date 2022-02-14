<?php namespace Modules\Backend\Models;

use ci4mongodblibrary\Libraries\Mongo;
use Config\MongoConfig;

/**
 *
 */
class UserscrudModel
{
    /**
     * @var Mongo
     */
    protected $m;
    /**
     * @var string
     */
    protected $table;
    /**
     * @var
     */
    protected $pre;

    /**
     * @param string $dbInfo
     */
    public function __construct($dbInfo = 'default')
    {
        $this->m = new Mongo();
        $this->table = 'users';
        $this->pre = new MongoConfig();
        $this->pre = $this->pre->dbInfo[$dbInfo]->prefix;
    }

    /**
     * @param int $limit
     * @param array $select
     * @param array $credentials
     * @return mixed
     */
    public function loggedUser(int $limit, array $select = [], array $credentials = [])
    {
        $data = [
            [
                '$lookup' => [
                    'from' => $this->pre . 'auth_groups',
                    'localField' => 'group_id',
                    'foreignField' => '_id',
                    'as' => 'groupInfo'
                ]
            ]
        ];

        if ($limit > 0)
            $data[] = ['$limit' => $limit];
        if (!empty($credentials))
            $data[] = ['$match' => $credentials];
        if (!empty($select))
            $data[] = ['$project' => $select];

        return $this->m->aggregate($this->table, $data)->toArray();
    }

    /**
     * @param int $limit
     * @param array $select
     * @param array $credentials
     * @param null $skip
     * @return mixed
     */
    public function userList(int $limit, array $select = [], array $credentials = [], $skip = null)
    {
        $data = [
            [
                '$lookup' => [
                    'from' => $this->pre . 'auth_groups',
                    'localField' => 'group_id',
                    'foreignField' => '_id',
                    'as' => 'groupInfo'
                ]
            ],
            ['$unwind' => ['path' => '$groupInfo', 'preserveNullAndEmptyArrays' => true]],
            [
                '$lookup' => [
                    'from' => $this->pre . 'black_list_users',
                    'localField' => '_id',
                    'foreignField' => 'blacked_id',
                    'as' => 'inBlackList'
                ]
            ],
            ['$unwind' => ['path' => '$inBlackList', 'preserveNullAndEmptyArrays' => true]]
        ];

        if ($limit > 0)
            $data[] = ['$limit' => $limit];
        if (!empty($skip))
            $date[] = ['$skip' => $skip];
        if (!empty($credentials))
            $data[] = ['$match' => $credentials];
        if (!empty($select))
            $data[] = ['$project' => $select];

        return $this->m->aggregate($this->table, $data)->toArray();
    }
}
