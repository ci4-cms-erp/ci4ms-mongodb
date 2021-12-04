<?php

namespace Modules\Backend\Controllers;

class Menu extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return view('Modules\Backend\Views\menu',$this->defData);
    }

    public function create()
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update_ajax(string $id)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete_ajax(string $id)
    {
        //
    }

    public function queue_ajax()
    {
        if($this->request->isAJAX()){
            echo 'burada';
        }
        else
            redirect(route_to('403'));
    }
}
