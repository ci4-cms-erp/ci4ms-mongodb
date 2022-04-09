<?php namespace Config;
use CodeIgniter\Config\AutoloadConfig;

class Autoload extends AutoloadConfig
{

    public $psr4 = [
        APP_NAMESPACE => APPPATH,
        'Config' => APPPATH . 'Config',
        'Commands' => APPPATH . 'Commands',
        'Modules' => ROOTPATH . 'modules',
        'Modules\Auth' => ROOTPATH . 'modules/Auth',
        'Modules\Backend' => ROOTPATH . 'modules/Backend'
    ];
    public $classmap = [];

}
