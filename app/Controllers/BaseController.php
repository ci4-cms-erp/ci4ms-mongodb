<?php

namespace App\Controllers;

use App\Models\Ci4ms;
use ci4mongodblibrary\Models\CommonModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use ci4mongodblibrary\Libraries\Mongo;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    protected $mongo;
    public $defData;
    public $commonModel;
    public $ci4msModel;

    /**
     * Constructor.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param LoggerInterface $logger
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        $this->parser=service('parser');
        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.: $this->session = \Config\Services::session();
        $this->mongo = new Mongo();
        $this->commonModel = new CommonModel();
        $this->ci4msModel=new Ci4ms();
        $this->defData = ['logo' => $this->commonModel->getOne('settings', [],[],['logo','siteName','commpanyAddtess','companyEMail','slogan','companyPhone','socialNetwork']),
            'menus' =>$this->commonModel->getList('menu',[],['sort' =>['queue'=>1]]),
            'settings'=>$this->commonModel->getOne('settings')];
    }
}
