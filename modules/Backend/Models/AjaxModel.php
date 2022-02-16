<?php namespace Modules\Backend\Models;

<<<<<<< HEAD
use CodeIgniter\Model;
use ci4mongodblibrary\Libraries\Mongo;
use Config\MongoConfig;

class AjaxModel extends Model
=======
use ci4mongodblibrary\Libraries\Mongo;
use Config\MongoConfig;

class AjaxModel
>>>>>>> dev
{
    protected $m;
    protected $mongoConfig;
    protected $databaseGroup = 'default';

    public function __construct()
    {
<<<<<<< HEAD
        parent::__construct();
=======
>>>>>>> dev
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
<<<<<<< HEAD
        $query[]=['$group'=>['_id'=>['id'=>'$_id','value'=>'$tag']]];
=======
        $query[]=['$group'=>['_id'=>['id'=>'$_id','value'=>'$tag','seflink'=>'$seflink']]];
>>>>>>> dev
        return $this->m->options($options)->aggregate('tags', $query)->toArray();
    }
}
