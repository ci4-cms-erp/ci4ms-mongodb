<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Errors extends BaseController
{
    public function error404()
    {
<<<<<<< HEAD
        echo view('templates/default-template/404');
=======
        echo view('templates/default/404',$this->defData);
>>>>>>> dev
    }
}
