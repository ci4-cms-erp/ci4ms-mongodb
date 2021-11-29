<?php

namespace Modules\Backend\Controllers;

use JasonGrimes\Paginator;
use MongoDB\BSON\ObjectId;

class Tags extends BaseController
{
    public function index()
    {
        $totalItems = $this->commonModel->count('pages',[]);
        $itemsPerPage = 20;
        $currentPage = $this->request->uri->getSegment('3', 1);
        $urlPattern = '/backend/pages/(:num)';
        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        $paginator->setMaxPagesToShow(5);
        $this->defData['paginator'] = $paginator;
        $bpk = ($this->request->uri->getSegment(3, 1) - 1) * $itemsPerPage;
        $this->defData['tags']=$this->commonModel->getList('tags',[],['$limit'=>$itemsPerPage,'$skip'=>$bpk]);
        return view('Modules\Backend\Views\tags\list',$this->defData);
    }

    public function create()
    {
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
        
    }
}
