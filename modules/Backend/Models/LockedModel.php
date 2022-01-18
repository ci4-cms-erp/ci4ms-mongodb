<?php namespace Modules\Backend\Models;

use ci4mongodblibrary\Libraries\Mongo;
use Config\MongoConfig;
use MongoDB\BSON\Regex;

class LockedModel
{
    protected $table;
    protected $m;
    protected $databaseGroup = 'default';
    protected $mongoConfig;

    public function __construct()
    {
        $this->m = new Mongo($this->databaseGroup);
        $this->mongoConfig = new MongoConfig();
        $this->table = 'locked';
    }

    public function countLike(array $where, string $collection, array $options = [])
    {
        return $this->m->options($options)->where($where)->count($collection);

    }
}
