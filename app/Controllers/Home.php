<?php

namespace App\Controllers;

use Melbahja\Seo\MetaTags;

class Home extends BaseController
{
    public function index($seflink = '/')
    {
        if ($this->commonModel->get_where(['seflink' => $seflink,'isActive'=>true], 'pages') === 1) {
        $this->defData['pageInfo'] = $this->commonModel->getOne('pages', ['seflink' => $seflink]);
        $metatags = new MetaTags();

        $metatags->title($this->defData['pageInfo']->title);
        if (!empty($this->defData['pageInfo']->seo->description))
            $metatags->description($this->defData['pageInfo']->seo->description);
        if (!empty($this->defData['pageInfo']->seo->coverImage))
            $metatags->image($this->defData['pageInfo']->seo->coverImage);
        $metatags->canonical(site_url($seflink));
        $this->defData['seo'] = $metatags;
        return view('templates/default-template/pages',$this->defData);
    }
        return throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    public function maintenanceMode()
    {
        return view('maintenance');
    }
//TODO: In preparation
    public function blog($seflink)
    {

    }
}
