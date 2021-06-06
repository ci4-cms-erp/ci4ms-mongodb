<?php namespace Modules\Backend\Controllers;

class Backend extends BaseController
{
	public function index()
	{
		return view('Modules\Backend\Views\welcome_message',$this->defData);
	}
}
