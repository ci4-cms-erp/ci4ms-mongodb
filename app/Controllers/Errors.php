<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Errors extends BaseController
{
    public function error404()
    {
        echo view('templates/default-template/404',$this->defData);
    }
}
