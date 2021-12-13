<?php

namespace Modules\Backend\Controllers;

use JasonGrimes\Paginator;
use Modules\Backend\Libraries\CommonTagsLibrary;
use Modules\Backend\Models\AjaxModel;
use MongoDB\BSON\ObjectId;

class Blog extends BaseController
{
    private $commonTagsLib;
    private $model;

    public function __construct()
    {
        $this->model = new AjaxModel();
        $this->commonTagsLib = new CommonTagsLibrary();
    }

    public function index()
    {
        $totalItems = $this->commonModel->count('categories', []);
        $itemsPerPage = 20;
        $currentPage = $this->request->uri->getSegment(3, 1);
        $urlPattern = '/backend/blogs/(:num)';
        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        $paginator->setMaxPagesToShow(5);
        $bpk = ($this->request->uri->getSegment(3, 1) - 1) * $itemsPerPage;
        $this->defData = array_merge($this->defData, ['paginator' => $paginator, 'blogs' => $this->commonModel->getList('blog', [], ['$limit' => $itemsPerPage, '$skip' => $bpk])]);
        return view('Modules\Backend\Views\blog\list', $this->defData);
    }

    public function new()
    {
        $this->defData['categories'] = $this->commonModel->getList('categories');
        return view('Modules\Backend\Views\blog\create', $this->defData);
    }

    public function create()
    {
        $valData = ([
            'title' => ['label' => 'Sayfa Başlığı', 'rules' => 'required'],
            'seflink' => ['label' => 'Sayfa URL', 'rules' => 'required'],
            'content' => ['label' => 'İçerik', 'rules' => 'required'],
            'isActive' => ['label' => 'Yayın veya taslak', 'rules' => 'required'],
            'categories' => ['label' => 'Kategoriler', 'rules' => 'required']
        ]);
        if (!empty($this->request->getPost('pageimg'))) {
            $valData['pageimg'] = ['label' => 'Görsel URL', 'rules' => 'required|valid_url'];
            $valData['pageIMGWidth'] = ['label' => 'Görsel Genişliği', 'rules' => 'required|is_natural_no_zero'];
            $valData['pageIMGHeight'] = ['label' => 'Görsel Yüksekliği', 'rules' => 'required|is_natural_no_zero'];
        }
        if (!empty($this->request->getPost('description'))) $valData['description'] = ['label' => 'Seo Açıklaması', 'rules' => 'required'];
        if (!empty($this->request->getPost('keywords'))) $valData['keywords'] = ['label' => 'Seo Anahtar Kelimeleri', 'rules' => 'required'];
        if ($this->validate($valData) == false) return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        if ($this->commonModel->get_where(['seflink' => $this->request->getPost('seflink')], 'blog') === 1) return redirect()->back()->withInput()->with('error', 'Blog seflink adresi daha önce kullanılmış. lütfen kontrol ederek bir daha oluşturmayı deneyeyiniz.');

        $data = ['title' => $this->request->getPost('title'), 'content' => $this->request->getPost('content'), 'isActive' => (bool)$this->request->getPost('isActive'), 'seflink' => $this->request->getPost('seflink'), 'inMenu' => false, 'categories' => $this->request->getPost('categories')];

        if (!empty($this->request->getPost('pageimg'))) {
            $data['seo']['coverImage'] = $this->request->getPost('pageimg');
            $data['seo']['IMGWidth'] = $this->request->getPost('pageIMGWidth');
            $data['seo']['IMGHeight'] = $this->request->getPost('pageIMGHeight');
        }
        if (!empty($this->request->getPost('description'))) $data['seo']['description'] = $this->request->getPost('description');

        $insertID = $this->commonModel->createOne('blog', $data);
        if ($insertID) {
            if (!empty($this->request->getPost('keywords'))) $this->commonTagsLib->checkTags($this->request->getPost('keywords'), 'blogs', (string)$insertID, 'tags');
            return redirect()->route('blogs', [1])->with('message', '<b>' . $this->request->getPost('title') . '</b> adlı blog oluşturuldu.');
        } else return redirect()->back()->withInput()->with('error', 'Blog oluşturulamadı.');
    }

    public function edit(string $id)
    {
        $this->defData['tags'] = $this->model->limitTags_ajax(['pivot.tagType' => 'blogs', 'pivot.piv_id' => new ObjectId($id)], []);
        $t = [];
        foreach ($this->defData['tags'] as $tag) {
            $t[] = ['id' => (string)$tag->_id->id, 'value' => $tag->_id->value];
        }
        $this->defData['categories'] = $this->commonModel->getList('categories');
        $this->defData['infos'] = $this->commonModel->getOne('blog', ['_id' => new ObjectId($id)]);
        $this->defData['tags'] = json_encode($t);
        unset($t);
        return view('Modules\Backend\Views\blog\update', $this->defData);
    }

    public function update(string $id)
    {
        $valData = ([
            'title' => ['label' => 'Sayfa Başlığı', 'rules' => 'required'],
            'seflink' => ['label' => 'Sayfa URL', 'rules' => 'required'],
            'content' => ['label' => 'İçerik', 'rules' => 'required'],
            'isActive' => ['label' => 'Yayın veya taslak', 'rules' => 'required'],
            'categories' => ['label' => 'Kategoriler', 'rules' => 'required']
        ]);
        if (!empty($this->request->getPost('pageimg'))) {
            $valData['pageimg'] = ['label' => 'Görsel URL', 'rules' => 'required|valid_url'];
            $valData['pageIMGWidth'] = ['label' => 'Görsel Genişliği', 'rules' => 'required|is_natural_no_zero'];
            $valData['pageIMGHeight'] = ['label' => 'Görsel Yüksekliği', 'rules' => 'required|is_natural_no_zero'];
        }
        if (!empty($this->request->getPost('description'))) $valData['description'] = ['label' => 'Seo Açıklaması', 'rules' => 'required'];
        if (!empty($this->request->getPost('keywords'))) $valData['keywords'] = ['label' => 'Seo Anahtar Kelimeleri', 'rules' => 'required'];
        if ($this->validate($valData) == false) return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        $info = $this->commonModel->getOne('blog', ['_id' => new ObjectId($id)]);
        if ($info->seflink != $this->request->getPost('seflink') && $this->commonModel->get_where(['seflink' => $this->request->getPost('seflink')], 'categories') === 1) return redirect()->back()->withInput()->with('error', 'Blog seflink adresi daha önce kullanılmış. lütfen kontrol ederek bir daha oluşturmayı deneyeyiniz.');
        $data = ['title' => $this->request->getPost('title'), 'content' => $this->request->getPost('content'), 'isActive' => (bool)$this->request->getPost('isActive'), 'seflink' => $this->request->getPost('seflink'), 'categories' => $this->request->getPost('categories')];

        if (!empty($this->request->getPost('pageimg'))) {
            $data['seo']['coverImage'] = $this->request->getPost('pageimg');
            $data['seo']['IMGWidth'] = $this->request->getPost('pageIMGWidth');
            $data['seo']['IMGHeight'] = $this->request->getPost('pageIMGHeight');
        }
        if (!empty($this->request->getPost('description'))) $data['seo']['description'] = $this->request->getPost('description');

        if ($this->commonModel->updateOne('blog', ['_id' => new ObjectId($id)], $data)) {
            if (!empty($this->request->getPost('keywords'))) $this->commonTagsLib->checkTags($this->request->getPost('keywords'), 'blogs', $id, 'tags');
            return redirect()->route('blogs', [1])->with('message', '<b>' . $this->request->getPost('title') . '</b> adlı blog oluşturuldu.');
        } else return redirect()->back()->withInput()->with('error', 'Blog oluşturulamadı.');
    }

    public function delete($id = null)
    {
        if ($this->commonModel->deleteMany('tags_pivot', ['piv_id' => new ObjectId($id), 'tagType' => 'blogs'])) {
            if ($this->commonModel->deleteOne('blog', ['_id' => new ObjectId($id)]) === true) return redirect()->route('blogs', [1])->with('message', 'blog silindi.');
            else return redirect()->back()->withInput()->with('error', 'Blog Silinemedi.');
        } else return redirect()->back()->withInput()->with('error', 'Blog Silinemedi.');
    }
}
