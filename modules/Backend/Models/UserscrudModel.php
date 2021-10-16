<?php namespace Modules\Backend\Models;

use ci4mongodblibrary\Libraries\Mongo;
use CodeIgniter\Model;
use Config\MongoConfig;

class UserscrudModel extends Model
{
    protected $m;
    protected $table;
    protected $pre;

    public function __construct()
    {
        parent::__construct();
        $this->m = new Mongo();
        $this->table='users';
        $this->pre=new MongoConfig();
        $this->pre=$this->pre->prefix;
    }

    public function loggedUser(int $limit, array $select = [], array $credentials = [])
    {
        $data = [
            [
                '$lookup' => [
                    'from' => $this->pre.'auth_groups',
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

    public function userList(int $limit, array $select = [], array $credentials = [], $skip=null)
    {
        $data = [
            [
                '$lookup' => [
                    'from' => $this->pre.'auth_groups',
                    'localField' => 'group_id',
                    'foreignField' => '_id',
                    'as' => 'groupInfo'
                ]
            ],
            ['$unwind' => ['path'=>'$groupInfo','preserveNullAndEmptyArrays'=>true]],
            [
                '$lookup' => [
                    'from' => $this->pre.'black_list_users',
                    'localField' => '_id',
                    'foreignField' => 'blacked_id',
                    'as' => 'inBlackList'
                ]
            ],
            ['$unwind' => ['path'=>'$inBlackList','preserveNullAndEmptyArrays'=>true]]
        ];

        if ($limit > 0)
            $data[] = ['$limit' => $limit];
        if(!empty($skip))
            $date[]=['$skip'=>$skip];
        if (!empty($credentials))
            $data[] = ['$match' => $credentials];
        if (!empty($select))
            $data[] = ['$project' => $select];

        return $this->m->aggregate($this->table, $data)->toArray();
    }
}
