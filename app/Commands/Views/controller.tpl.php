<@php

<<<<<<< HEAD
namespace {namespace};
=======
namespace Modules\Backend\Controllers;
>>>>>>> dev

class {class} extends {extends}
{
<?php if ($type === 'controller'): ?>
<<<<<<< HEAD
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
=======
    public function index()
    {
        return view('Modules\Backend\Views\',$this->defData);
    }

>>>>>>> dev
    public function show($id = null)
    {
        //
    }

<<<<<<< HEAD
    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
=======
>>>>>>> dev
    public function new()
    {
        //
    }

<<<<<<< HEAD
    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
=======
>>>>>>> dev
    public function create()
    {
        //
    }

<<<<<<< HEAD
    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
=======
>>>>>>> dev
    public function edit($id = null)
    {
        //
    }

<<<<<<< HEAD
    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
=======
>>>>>>> dev
    public function update($id = null)
    {
        //
    }

<<<<<<< HEAD
    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
=======
>>>>>>> dev
    public function delete($id = null)
    {
        //
    }
<?php elseif ($type === 'presenter'): ?>
<<<<<<< HEAD
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        //
    }

    /**
     * Present a view to present a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
=======
    public function index()
    {
        return view('Modules\Backend\Views\',$this->defData);
    }

>>>>>>> dev
    public function show($id = null)
    {
        //
    }

<<<<<<< HEAD
    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
=======
>>>>>>> dev
    public function new()
    {
        //
    }

<<<<<<< HEAD
    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
=======
>>>>>>> dev
    public function create()
    {
        //
    }

<<<<<<< HEAD
    /**
     * Present a view to edit the properties of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
=======
>>>>>>> dev
    public function edit($id = null)
    {
        //
    }

<<<<<<< HEAD
    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
=======
>>>>>>> dev
    public function update($id = null)
    {
        //
    }

<<<<<<< HEAD
    /**
     * Present a view to confirm the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
=======
>>>>>>> dev
    public function remove($id = null)
    {
        //
    }

<<<<<<< HEAD
    /**
     * Process the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
=======
>>>>>>> dev
    public function delete($id = null)
    {
        //
    }
<?php else: ?>
    public function index()
    {
<<<<<<< HEAD
        //
=======
        return view('Modules\Backend\Views\',$this->defData);
>>>>>>> dev
    }
<?php endif ?>
}
