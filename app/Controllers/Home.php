<?php

namespace App\Controllers;

use Melbahja\Seo\MetaTags;
use Modules\Backend\Models\AjaxModel;
use MongoDB\BSON\ObjectId;

class Home extends BaseController
{
    public function index(string $seflink = '/')
    {
        if ($this->commonModel->get_where(['seflink' => $seflink, 'isActive' => true], 'pages') === 1) {
            $this->defData['pageInfo'] = $this->commonModel->getOne('pages', ['seflink' => $seflink]);
            $metatags = new MetaTags();

            $metatags->title($this->defData['pageInfo']->title);
            if (!empty($this->defData['pageInfo']->seo->description)) $metatags->description($this->defData['pageInfo']->seo->description);
            if (!empty($this->defData['pageInfo']->seo->coverImage)) $metatags->image($this->defData['pageInfo']->seo->coverImage);
            if (!empty($this->defData['pageInfo']->seo->keywords)) $metatags->meta('keywords',$this->defData['pageInfo']->seo->keywords);
            $metatags->canonical(site_url($seflink));
            $this->defData['seo'] = $metatags;
            return view('templates/default-template/pages', $this->defData);
        } else return show_404();
    }

    public function maintenanceMode()
    {
        return view('maintenance');
    }

//TODO: In preparation
    public function blog()
    {

    }

    public function blogDetail(string $seflink)
    {
        if ($this->commonModel->get_where(['seflink' => $seflink, 'isActive' => true], 'blog') === 1) {
            $metatags = new MetaTags();
            $this->defData['infos'] = $this->commonModel->getOne('blog', ['seflink' => $seflink]);
            $metatags->title($this->defData['infos']->title);
            if (!empty($this->defData['infos']->seo->description)) $metatags->description($this->defData['infos']->seo->description);
            if (!empty($this->defData['infos']->seo->coverImage)) $metatags->image($this->defData['infos']->seo->coverImage);
            $modelTag=new AjaxModel();
            $this->defData['tags']=$modelTag->limitTags_ajax(['pivot.piv_id'=>$this->defData['infos']->_id]);
            if (!empty($this->defData['tags'])) {
                $keywords='';
                foreach ($this->defData['tags'] as $tag) {
                    $keywords.=$tag->_id->value;
                }
                $metatags->meta('keywords', $keywords);
            }
            $metatags->meta('author', $this->defData['infos']->author);
            $metatags->canonical(site_url($seflink));
            $this->defData['seo'] = $metatags;
            return view('templates/default-template/blog/post', $this->defData);
        } else return show_404();
    }

    public function tagList(string $seflink)
    {
        if ($this->commonModel->get_where(['seflink' => $seflink], 'tags') === 1) {

        }else return show_404();
    }
}
