<?php

namespace App\Controllers;

use App\Libraries\CommonLibrary;
use CodeIgniter\I18n\Time;
use JasonGrimes\Paginator;
use Modules\Backend\Models\AjaxModel;
use Modules\Backend\Models\UserscrudModel;
use MongoDB\BSON\ObjectId;

class Home extends BaseController
{
    private $commonLibrary;

    public function __construct()
    {
        $this->commonLibrary = new CommonLibrary();
    }

    public function index(string $seflink = '/')
    {
        if ($this->commonModel->get_where(['seflink' => $seflink, 'isActive' => true], 'pages') === 1) {
            $this->defData['pageInfo'] = $this->commonModel->getOne('pages', ['seflink' => $seflink]);
            $this->defData['pageInfo']->content= $this->commonLibrary->parseInTextFunctions($this->defData['pageInfo']->content);
            $keywords = [];
            if (!empty($this->defData['pageInfo']->seo->keywords)) {
                foreach ($this->defData['pageInfo']->seo->keywords as $keyword) {
                    $keywords[] = $keyword->value;
                }
            }
            $this->defData['seo'] = $this->commonLibrary->seo($this->defData['pageInfo']->title, $this->defData['pageInfo']->seo->description, $seflink, $metatags = ['keywords' => $keywords], !empty($this->defData['pageInfo']->seo->coverImage)?$this->defData['pageInfo']->seo->coverImage:'');
            return view('templates/default-template/pages', $this->defData);
        } else return show_404();
    }

    public function maintenanceMode()
    {
        return view('maintenance');
    }

    public function blog()
    {
        $totalItems = $this->commonModel->count('blog', ['isActive' => true]);
        $itemsPerPage = 12;
        $currentPage = $this->request->uri->getSegment(2, 1);
        $urlPattern = '/blog/(:num)';
        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        $paginator->setMaxPagesToShow(5);
        $this->defData['paginator'] = $paginator;
        $bpk = ($this->request->uri->getSegment(2, 1) - 1) * $itemsPerPage;
        $this->defData['dateI18n'] = new Time();
        $this->defData['blogs'] = $this->commonModel->getList('blog', ['isActive' => true], ['$limit' => $itemsPerPage, '$skip' => $bpk]);
        $modelTag = new AjaxModel();
        foreach ($this->defData['blogs'] as $key => $blog) {
            $this->defData['blogs'][$key]['tags'] = $modelTag->limitTags_ajax(['pivot.piv_id' => $blog->_id]);
            $this->defData['blogs'][$key]['author'] = $this->commonModel->getOne('users', ['_id' => new ObjectId($blog->author)], ['firstname', 'sirname']);
        }
        $this->defData['categories'] = $this->commonModel->getList('categories');
        return view('templates/default-template/blog/list', $this->defData);
    }

    public function blogDetail(string $seflink)
    {
        if ($this->commonModel->get_where(['seflink' => $seflink, 'isActive' => true], 'blog') === 1) {
            $this->defData['infos'] = $this->commonModel->getOne('blog', ['seflink' => $seflink]);
            $userModel = new UserscrudModel();
            $this->defData['authorInfo'] = $userModel->loggedUser(0, [], ['_id' => new ObjectId($this->defData['infos']->author)]);
            $this->defData['authorInfo'] = $this->defData['authorInfo'][0];
            $this->defData['dateI18n'] = new Time();
            $modelTag = new AjaxModel();
            $this->defData['tags'] = $modelTag->limitTags_ajax(['pivot.piv_id' => $this->defData['infos']->_id]);
            if (!empty($this->defData['tags'])) {
                $keywords = [];
                foreach ($this->defData['tags'] as $tag) {
                    $keywords[] = $tag->_id->value;
                }
            }
            $this->defData['seo'] = $this->commonLibrary->seo($this->defData['infos']->title, $this->defData['infos']->seo->description, 'blog/' . $seflink, $metatags = ['keywords' => $keywords, 'author' => $this->defData['authorInfo']->firstname . ' ' . $this->defData['authorInfo']->sirname], $this->defData['infos']->seo->coverImage);
            $this->defData['categories'] = $this->commonModel->getList('categories');
            return view('templates/default-template/blog/post', $this->defData);
        } else return show_404();
    }

    public function tagList(string $seflink)
    {
        if ($this->commonModel->get_where(['seflink' => $seflink], 'tags') === 1) {

        } else return show_404();
    }
}
