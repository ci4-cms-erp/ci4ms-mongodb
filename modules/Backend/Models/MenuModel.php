<?php namespace Modules\Backend\Models;

use ci4mongodblibrary\Libraries\Mongo;
use Config\MongoConfig;

class MenuModel
{
    protected $table;
    protected $m;
    protected $databaseGroup = 'default';
    protected $mongoConfig;

    public function __construct()
    {
        $this->m = new Mongo($this->databaseGroup);
        $this->table='menu';
        $this->mongoConfig = new MongoConfig();
    }

    public function nestable2(){
        return $this->m->aggregate($this->table,[
            ['$lookup'=>['from'=>$this->mongoConfig->dbInfo[$this->databaseGroup]->prefix.'pages',
                'localField'=>'pages_id',
                'foreignField' =>'_id',
                'as'=>'pages'
            ]],
            ['$unwind'=>['path'=>'$pages','preserveNullAndEmptyArrays'=>true]],
            ['$project'=>["pages.title"=>true,"parent"=>true,"pages_id"=>true]]
        ])->toArray();
    }
}
