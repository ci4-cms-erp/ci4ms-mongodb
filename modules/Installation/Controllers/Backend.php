<?php namespace Modules\Backend\Controllers;

use CodeIgniter\HTTP\Response;
use Modules\Auth\Models\UserModel;

class Backend extends BaseController
{
	public function index()
	{
		return view('Modules\Backend\Views\welcome_message',$this->defData);
	}
}
