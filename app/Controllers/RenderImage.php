<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use Exception;

class RenderImage extends Controller
{
    public function index($imageName)
    {
        if(($image = file_get_contents(WRITEPATH.'uploads/'.$imageName)) === FALSE)
            show_404();

        $this->response
            ->setStatusCode(200)
            ->setBody($image)
            ->send();
    }
}