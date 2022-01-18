<?php
namespace Modules\Backend\Controllers;

use JasonGrimes\Paginator;
use Modules\Backend\Models\LockedModel;
use MongoDB\BSON\Regex;


class Locked extends BaseController
{
    public $lockedModel;

    public function index()
    {
        $this->lockedModel = new LockedModel();

        //dd($this->request->getGet('status'));

        $filterData = [];
        if(!empty($this->request->getGet())){
            $clearData = clearFilter($this->request->getGet());
            $filterData = [
                'username' => (isset($clearData['email'])) ? new Regex($clearData['email']) : null,
                'ip_address' => (isset($clearData['ip'])) ? new Regex($clearData['ip']): null,
                'isLocked' =>(isset($clearData['status'])) ? (bool)$clearData['status'] : null,
            ];
            $filterData = clearFilter($filterData);
        }
        $totalItems = $this->commonModel->count('locked',$filterData);
        $itemsPerPage = 10;
        $currentPage = $this->request->uri->getSegment(3, 1);
        $urlPattern = '/backend/locked/(:num)';
        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        $paginator->setMaxPagesToShow(5);
        $bpk = ($this->request->uri->getSegment(3, 1) - 1) * $itemsPerPage;
        $this->defData = array_merge($this->defData, [
            'paginator' => $paginator,
            'locks' => $this->commonModel->getList('locked', $filterData , ['limit' => $itemsPerPage, 'skip' => $bpk]),
            'totalCount' => $totalItems,
        ]);
        return view('Modules\Backend\Views\logs\locked', $this->defData);
    }
}
