<?php namespace Modules\Backend\Controllers;

class Errors extends BaseController
{
    public function error_403()
    {
        return view('Modules\Backend\Views\errors\html\error_403', $this->defData);
    }
}
