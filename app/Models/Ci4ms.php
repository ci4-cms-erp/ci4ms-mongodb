<?php

namespace App\Models;

use ci4mongodblibrary\Libraries\Mongo;
use Config\MongoConfig;

class Ci4ms
{
    protected $commonModel;
    protected $databaseGroup = 'default';
    protected $mongoConfig;

    public function __construct()
    {
        $this->m = new Mongo();
        $this->table = 'users';
        $this->pre = new MongoConfig();
        $this->pre = $this->pre->dbInfo[$this->databaseGroup]->prefix;
        $this->mongoConfig = new MongoConfig();
    }

    public function taglist(array $credentials = [], array $options = [],int $limit=10, int $skip = 0)
    {
        $query = [
            [
                '$lookup' => [
                    'from' => $this->mongoConfig->dbInfo[$this->databaseGroup]->prefix . 'blog',
                    'localField' => 'piv_id',
                    'foreignField' => '_id',
                    'as' => 'blogs'
                ]
            ],
            ['$unwind' => ['path' => '$blogs', 'preserveNullAndEmptyArrays' => true]],
            [
                '$lookup' => [
                    'from' => $this->mongoConfig->dbInfo[$this->databaseGroup]->prefix . 'tags',
                    'localField' => 'tag_id',
                    'foreignField' => '_id',
                    'as' => 'pivot'
                ]
            ],
            ['$unwind' => ['path' => '$pivot', 'preserveNullAndEmptyArrays' => true]],
            ['$limit'=>$limit],
            ['$skip'=>$skip],
        ];
        if (!empty($credentials))
            $query[] = ['$match' => $credentials];
        $query[]=['$group'=>['_id'=>['blogs'=>'$blogs']]];
        return $this->m->options($options)->aggregate('tags_pivot', $query)->toArray();
    }

    public function categoryList(string $field,array $credentials,array $where=[],array $options=[])
    {
        return $this->m->options($options)->where($where)->where_in($field,$credentials)->find('blog')->toArray();
    }
}
