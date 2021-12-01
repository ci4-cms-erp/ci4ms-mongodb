<?php

namespace Modules\Backend\Controllers;

use JasonGrimes\Paginator;
use Modules\Backend\Models\AjaxModel;
use MongoDB\BSON\ObjectId;

class Pages extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new AjaxModel();
    }

    public function index()
    {
        $totalItems = $this->commonModel->count('pages', []);
        $itemsPerPage = 20;
        $currentPage = $this->request->uri->getSegment('3', 1);
        $urlPattern = '/backend/pages/(:num)';
        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        $paginator->setMaxPagesToShow(5);
        $this->defData['paginator'] = $paginator;
        $bpk = ($this->request->uri->getSegment(3, 1) - 1) * $itemsPerPage;
        $this->defData['pages'] = $this->commonModel->getList('pages', [], ['$limit' => $itemsPerPage, '$skip' => $bpk]);
        return view('Modules\Backend\Views\pages\list', $this->defData);
    }

    public function create()
    {
        return view('Modules\Backend\Views\pages\create', $this->defData);
    }

    public function create_post()
    {
        $valData = ([
            'title' => ['label' => 'Sayfa Başlığı', 'rules' => 'required'],
            'seflink' => ['label' => 'Sayfa URL', 'rules' => 'required'],
            'content' => ['label' => 'İçerik', 'rules' => 'required'],
            'isActive' => ['label' => 'Yayın veya taslak', 'rules' => 'required']
        ]);
        if (!empty($this->request->getPost('pageimg'))) {
            $valData['pageimg'] = ['label' => 'Görsel URL', 'rules' => 'required|valid_url'];
            $valData['pageIMGWidth'] = ['label' => 'Görsel Genişliği', 'rules' => 'required|is_natural_no_zero'];
            $valData['pageIMGHeight'] = ['label' => 'Görsel Yüksekliği', 'rules' => 'required|is_natural_no_zero'];
        }
        if (!empty($this->request->getPost('description')))
            $valData['description'] = ['label' => 'Seo Açıklaması', 'rules' => 'required'];
        if (!empty($this->request->getPost('keywords')))
            $valData['keywords'] = ['label' => 'Seo Anahtar Kelimeleri', 'rules' => 'required'];

        if ($this->validate($valData) == false)
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        $data = ['title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'isActive' => (bool)$this->request->getPost('isActive'),
            'seflink' => $this->request->getPost('seflink')
        ];

        if (!empty($this->request->getPost('pageimg'))) {
            $data['seo']['coverImage'] = $this->request->getPost('pageimg');
            $data['seo']['IMGWidth'] = $this->request->getPost('pageIMGWidth');
            $data['seo']['IMGHeight'] = $this->request->getPost('pageIMGHeight');
        }
        if (!empty($this->request->getPost('description')))
            $data['seo']['description'] = $this->request->getPost('description');

        $insertID = $this->commonModel->createOne('pages', $data);
        if ($insertID) {
            if (!empty($this->request->getPost('keywords'))) {
                $jsons = json_decode($this->request->getPost('keywords'));
                foreach ($jsons as $item) {
                    if (!empty($item->id)) {
                        $tag = $this->commonModel->getOne('tags', ['tag' => $item->value]);
                        if ($item->value == $tag->tag)
                            $this->commonModel->createOne('tags_pivot', ['tag_id' => new ObjectId($item->id), 'tagType' => 'page', 'piv_id' => new ObjectId($insertID)]);
                        else {
                            $this->commonModel->updateOne('tags', ['_id' => new ObjectId($item->id)], ['tag' => $item->value]);
                        }
                    } else {
                        $addedTagID = $this->commonModel->createOne('tags', ['tag' => $item->value, 'seflink' => seflink($item->value, true)]);
                        $this->commonModel->createOne('tags_pivot', ['tag_id' => new ObjectId($addedTagID), 'tagType' => 'page', 'piv_id' => new ObjectId($insertID)]);
                    }
                }
            }
            return redirect()->route('pages', [1])->with('message', '<b>' . $this->request->getPost('title') . '</b> adlı sayfa Oluşturuldu.');
        } else
            return redirect()->back()->withInput()->with('error', 'Sayfa oluşturulamadı.');
    }

    public function update($id)
    {
        $this->defData['pageInfo'] = $this->commonModel->getOne('pages', ['_id' => new ObjectId($id)]);
        $this->defData['tags'] = $this->model->limitTags_ajax(['pivot.tagType' => 'page', 'pivot.piv_id' => new ObjectId($id)], [], ['tag' => true]);
        $t = [];
        foreach ($this->defData['tags'] as $tag) {
            $t[] = ['id' => (string)$tag->_id, 'value' => $tag->tag];
        }
        $this->defData['tags'] = json_encode($t);
        unset($t);

        return view('Modules\Backend\Views\pages\update', $this->defData);
    }

    public function update_post($id)
    {
        $valData = ([
            'title' => ['label' => 'Sayfa Başlığı', 'rules' => 'required'],
            'seflink' => ['label' => 'Sayfa URL', 'rules' => 'required'],
            'content' => ['label' => 'İçerik', 'rules' => 'required'],
            'isActive' => ['label' => 'Yayın veya taslak', 'rules' => 'required']
        ]);
        if (!empty($this->request->getPost('pageimg'))) {
            $valData['pageimg'] = ['label' => 'Görsel URL', 'rules' => 'required|valid_url'];
            $valData['pageIMGWidth'] = ['label' => 'Görsel Genişliği', 'rules' => 'required|is_natural_no_zero'];
            $valData['pageIMGHeight'] = ['label' => 'Görsel Yüksekliği', 'rules' => 'required|is_natural_no_zero'];
        }
        if (!empty($this->request->getPost('description')))
            $valData['description'] = ['label' => 'Seo Açıklaması', 'rules' => 'required'];
        if (!empty($this->request->getPost('keywords')))
            $valData['keywords'] = ['label' => 'Seo Anahtar Kelimeleri', 'rules' => 'required'];

        if ($this->validate($valData) == false)
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        $data = ['title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'isActive' => (bool)$this->request->getPost('isActive'),
            'seflink' => $this->request->getPost('seflink')
        ];

        if (!empty($this->request->getPost('pageimg'))) {
            $data['seo']['coverImage'] = $this->request->getPost('pageimg');
            $data['seo']['IMGWidth'] = $this->request->getPost('pageIMGWidth');
            $data['seo']['IMGHeight'] = $this->request->getPost('pageIMGHeight');
        }

        if (!empty($this->request->getPost('description')))
            $data['seo']['description'] = $this->request->getPost('description');

        if (!empty($this->request->getPost('keywords'))) {
            $this->commonModel->deleteMany('tags_pivot', ['piv_id' => new ObjectId($id), 'tagType' => 'page']);
            $jsons = json_decode($this->request->getPost('keywords'));
            foreach ($jsons as $item) {
                if (!empty($item->id)) {
                    $tag = $this->commonModel->getOne('tags', ['tag' => $item->value]);
                    if ($item->value == $tag->tag)
                        $this->commonModel->createOne('tags_pivot', ['tag_id' => new ObjectId($item->id), 'tagType' => 'page', 'piv_id' => new ObjectId($id)]);
                    else {
                        $this->commonModel->updateOne('tags', ['_id' => new ObjectId($item->id)], ['tag' => $item->value]);
                    }
                } else {
                    $addedTagID = $this->commonModel->createOne('tags', ['tag' => $item->value, 'seflink' => seflink($item->value, true)]);
                    $this->commonModel->createOne('tags_pivot', ['tag_id' => new ObjectId($addedTagID), 'tagType' => 'page', 'piv_id' => new ObjectId($id)]);
                }
            }
        }

        if ($this->commonModel->updateOne('pages', ['_id' => new ObjectId($id)], $data))
            return redirect()->route('pages', [1])->with('message', '<b>' . $this->request->getPost('title') . '</b> adlı sayfa güncellendi.');
        else
            return redirect()->back()->withInput()->with('error', 'Sayfa oluşturulamadı.');
    }

    public function delete_post($id)
    {
        if ($this->commonModel->deleteMany('tags_pivot', ['piv_id' => new ObjectId($id), 'tagType' => 'page'])) {
            if ($this->commonModel->deteleOne('pages', ['_id' => new ObjectId($id)]))
                return redirect()->route('pages', [1])->with('message', '<b>' . $this->request->getPost('title') . '</b> adlı sayfa silindi.');
            else
                return redirect()->back()->withInput()->with('error', 'Sayfa Silinemedi.');
        } else
            return redirect()->back()->withInput()->with('error', 'Sayfa Silinemedi.');
    }
}
