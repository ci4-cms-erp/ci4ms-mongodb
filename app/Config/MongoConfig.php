<?php namespace Config;
use CodeIgniter\Config\BaseConfig;

class MongoConfig extends BaseConfig
{
    public $db = 'kun-cms'; //your database
    public $hostname = '127.0.0.1'; //if you use remote server you should change host address
    public $userName = 'beaver';
    public $password = 'RFVtgb1192';
    public $prefix = 'kun_';
    public $port = '27017'; //if you use different port you should change port address
}
