<?php
namespace Modules\Backend\Controllers;

use JasonGrimes\Paginator;

class Locked extends BaseController
{
    public function index()
    {
        $totalItems = $this->commonModel->count('locked', []);
        $itemsPerPage = 10;
        $currentPage = $this->request->uri->getSegment(3, 1);
        $urlPattern = '/backend/locked/(:num)';
        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        $paginator->setMaxPagesToShow(5);
        $bpk = ($this->request->uri->getSegment(3, 1) - 1) * $itemsPerPage;
        $this->defData = array_merge($this->defData, [
            'paginator' => $paginator,
            'locks' => $this->commonModel->getList('locked', [], ['limit' => $itemsPerPage, 'skip' => $bpk])
        ]);
        return view('Modules\Backend\Views\logs\locked', $this->defData);
    }
}
