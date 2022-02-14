<?php namespace Modules\Backend\Models;

use CodeIgniter\Model;
use ci4mongodblibrary\Libraries\Mongo;
use Config\MongoConfig;

class AjaxModel extends Model
{
    protected $m;
    protected $mongoConfig;
    protected $databaseGroup = 'default';

    public function __construct()
    {
        parent::__construct();
        $this->m = new Mongo($this->databaseGroup);
        $this->mongoConfig = new MongoConfig();
    }

    public function limitTags_ajax(array $credentials = [], array $options = [])
    {
        $query = [
            [
                '$lookup' => [
                    'from' => $this->mongoConfig->dbInfo[$this->databaseGroup]->prefix . 'tags_pivot',
                    'localField' => '_id',
                    'foreignField' => 'tag_id',
                    'as' => 'pivot'
                ]
            ],
            ['$unwind' => ['path' => '$pivot', 'preserveNullAndEmptyArrays' => true]],
            ['$sort'=>['_id'=>-1]],
            ['$limit'=>10]
        ];
        if (!empty($credentials))
            $query[] = ['$match' => $credentials];
        $query[]=['$group'=>['_id'=>['id'=>'$_id','value'=>'$tag']]];
        return $this->m->options($options)->aggregate('tags', $query)->toArray();
    }
}
