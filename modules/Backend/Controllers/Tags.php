<?php

namespace Modules\Backend\Controllers;

use JasonGrimes\Paginator;
use MongoDB\BSON\ObjectId;

class Tags extends BaseController
{
    public function index()
    {
<<<<<<< HEAD
        $totalItems = $this->commonModel->count('pages',[]);
        $itemsPerPage = 20;
        $currentPage = $this->request->uri->getSegment('3', 1);
=======
        $totalItems = $this->commonModel->count('tags',[]);
        $itemsPerPage = 20;
        $currentPage = $this->request->uri->getSegment(4, 1);
>>>>>>> dev
        $urlPattern = '/backend/pages/(:num)';
        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        $paginator->setMaxPagesToShow(5);
        $this->defData['paginator'] = $paginator;
<<<<<<< HEAD
        $bpk = ($this->request->uri->getSegment(3, 1) - 1) * $itemsPerPage;
        $this->defData['tags']=$this->commonModel->getList('tags',[],['$limit'=>$itemsPerPage,'$skip'=>$bpk]);
=======
        $bpk = ($this->request->uri->getSegment(4, 1) - 1) * $itemsPerPage;
        $this->defData['tags']=$this->commonModel->getList('tags',[],['limit'=>$itemsPerPage,'skip'=>$bpk]);
>>>>>>> dev
        return view('Modules\Backend\Views\tags\list',$this->defData);
    }

    public function create()
    {
<<<<<<< HEAD
        $this->defData['tags']=$this->commonModel->getList('tags',[],['$limit'=>10]);
        return view('Modules\Backend\Views\tags\create',$this->defData);
    }

    public function create_post()
    {

    }

    public function update($id)
    {
        
    }

    public function update_post($id)
    {
        
    }

    public function delete_post($id)
    {
        
=======
        $valData = (['title' => ['label' => 'Etiket Başlığı', 'rules' => 'required'], 'seflink' => ['label' => 'Etiket URL', 'rules' => 'required'],]);
        if ($this->validate($valData) == false) return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        if ($this->commonModel->createOne('tags', ['tag'=>$this->request->getPost('title'),'seflink'=>$this->request->getPost('seflink')])) return redirect()->route('tags', [1])->with('message', '<b>' . $this->request->getPost('title') . '</b> adlı etiket Oluşturuldu.');
        else return redirect()->back()->withInput()->with('error', 'Etiket oluşturulamadı.');
    }

    public function edit(string $id)
    {
        $this->defData['infos']=$this->commonModel->getOne('tags',['_id'=>new ObjectId($id)]);
        return view('Modules\Backend\Views\tags\update',$this->defData);
    }

    public function update(string $id)
    {
        $valData = (['title' => ['label' => 'Etiket Başlığı', 'rules' => 'required'], 'seflink' => ['label' => 'Etiket URL', 'rules' => 'required'],]);
        if ($this->validate($valData) == false) return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        if ($this->commonModel->updateOne('tags',['_id'=>new ObjectId($id)], ['tag'=>$this->request->getPost('title'),'seflink'=>$this->request->getPost('seflink')])) return redirect()->route('tags', [1])->with('message', '<b>' . $this->request->getPost('title') . '</b> adlı etiket güncellendi.');
        else return redirect()->back()->withInput()->with('error', 'Etiket güncellenemedi.');
    }

    public function delete(string $id)
    {
        if ($this->commonModel->deleteMany('kun_tags_pivot',[''=>new ObjectId($id)]) && $this->commonModel->deleteOne('tags',['_id'=>new ObjectId($id)])) return redirect()->route('tags', [1])->with('message', 'Etiket silindi.');
        else return redirect()->back()->withInput()->with('error', 'Etiket silinemedi.');
>>>>>>> dev
    }
}
