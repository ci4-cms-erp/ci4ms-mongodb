<?php

namespace Modules\Backend\Controllers;

use MongoDB\BSON\ObjectId;
use Modules\Backend\Models\MenuModel;

class Menu extends BaseController
{
    protected $model;

    public function __construct()
    {
        helper('Modules\Backend\Helpers\ci4ms');
        $this->model = new MenuModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $this->defData['pages'] = $this->commonModel->getList('pages', ['inMenu' => false, 'isActive' => true]);
        $this->defData['blogs'] = $this->commonModel->getList('blog',['inMenu'=>false,'isActive'=>true]);
        $this->defData['nestable2'] = $this->model->nestable2();
        return view('Modules\Backend\Views\menu\menu', $this->defData);
    }

    public function create()
    {
        if ($this->request->isAJAX()) {
            $added = $this->commonModel->getOne($this->request->getPost('where'), ['_id' => new ObjectId($this->request->getPost('id'))]);
            $pMax = $this->commonModel->getOne('menu', ['parent' => null], ['sort' => ['_id' => -1]]);
            if (empty($pMax))
                $pMax = (object)['queue' => 0];

            $data = ['urlType' => $this->request->getPost('where'),
                'pages_id' => new ObjectId($added->_id),
                'parent' => null,
                'queue' => $pMax->queue + 1];

            if ($this->commonModel->updateOne($this->request->getPost('where'),
                    ['_id' => new ObjectId($added->_id)],
                    ['inMenu' => true]) && $this->commonModel->createOne('menu', $data)) {
                $data = ['nestable2' => $this->model->nestable2()];
                return view('Modules\Backend\Views\menu\render-nestable2', $data);
            }
        } else
            return redirect()->route('403');
    }

    public function delete_ajax()
    {
        if ($this->request->isAJAX()) {
            if ($this->commonModel->updateMany('menu',
                    ['parent' => $this->request->getPost('id')], ['parent' => null])
                && $this->commonModel->deleteOne('menu',
                    ['pages_id' => new ObjectId($this->request->getPost('id')),
                        'urlType' => $this->request->getPost('type')])
                && $this->commonModel->updateOne('pages',
                    ['_id' => new ObjectId($this->request->getPost('id'))], ['inMenu' => false])) {
                $data = ['nestable2' => $this->model->nestable2()];
                return view('Modules\Backend\Views\menu\render-nestable2', $data);
            }
        } else return redirect()->route('403');
    }

    private function queue($menu, $parent = null, $oldData = null)
    {
        $i = 1;
        foreach ($menu as $d) {
            if (array_key_exists("children", $d)) {
                $this->queue($d['children'], $d['id']);
            }
            $type = 'pages';
            if (!empty($oldData)) {
                foreach ($oldData as $oldDatum) {
                    if ($oldDatum->pages_id == $d['id'])
                        $type = $oldDatum->urlType;
                }
            }
            $this->commonModel->createOne('menu', ['pages_id' => new ObjectId($d['id']), 'urlType' => $type, 'queue' => $i, 'parent' => $parent]);
            $i++;
        }
    }

    public function queue_ajax()
    {
        if ($this->request->isAJAX()) {
            $oldData = $this->commonModel->getList('menu');
            $this->commonModel->deleteMany('menu', []);
            $this->queue($this->request->getPost('queue'), null, $oldData);
        } else
            redirect(route_to('403'));
    }

    public function listURLs()
    {
        $this->defData['pages'] = $this->commonModel->getList('pages', ['inMenu' => false, 'isActive' => true]);
        $this->defData['blogs'] = $this->commonModel->getList('blog',['inMenu'=>false,'isActive'=>true]);
        return view('Modules\Backend\Views\menu\list', $this->defData);
    }
}
