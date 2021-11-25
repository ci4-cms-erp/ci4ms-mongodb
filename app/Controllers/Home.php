<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index($seflink = '/')
    {
        return view('templates/default-template/home');
    }

    public function maintenanceMode()
    {
        return view('maintenance');
    }
}
