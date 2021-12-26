<?php namespace App\Libraries\templates\default;

use ci4mongodblibrary\Models\CommonModel;

class Ci4mstemplateLib
{
    public $commonModel;

    public function __construct()
    {
        $this->commonModel = new CommonModel();
    }

    public static function contactForm()
    {
        return view('templates/default/contactForm');
    }

    public static function categories()
    {
        return view('templates/default/categories', ['categories' => $this->commonModel->getList('categories')]);
    }
}