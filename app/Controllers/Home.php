<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
	    print_r(session('redirect_url'));
	    die();
		return view('welcome_message');
	}
}
