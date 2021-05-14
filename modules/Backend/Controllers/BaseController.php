<?php

namespace Modules\Backend\Controllers;

use App\Models\CommonModel;
use Modules\Backend\Libraries\AuthLibrary;
use Modules\Backend\Config\Auth;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use Modules\Backend\Config\BackendConfig;
use Modules\Backend\Models\UserscrudModel;
use MongoDB\BSON\ObjectId;

class BaseController extends Controller
{
    public $logged_in_user;
    public $commonModel;
    public $perms;
    public $backConfig;
    public $defData;
    public $authLib;
    public $config;
    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['debug'];

    /**
     * Constructor.
     */
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.:
        // $this->session = \Config\Services::session();

        $this->config = new Auth();
        $this->backConfig = new BackendConfig();
        $this->authLib = new AuthLibrary();
        $this->commonModel = new CommonModel();
        $userModel = new UserscrudModel();

        $this->logged_in_user = $userModel->loggedUser(0, [], ['_id' => new ObjectId(session()->get('logged_in'))]);
        $this->logged_in_user = $this->logged_in_user[0];

        $uri='';
        if($this->request->uri->getTotalSegments()>1){
            $segs=$this->request->uri->getSegments();
            unset($segs[0]);
            foreach ($segs as $totalSegment) {
                $uri.='/'.$totalSegment;
            }
            $uri=substr($uri,1);
        }
        else
            $uri=$this->request->uri->getSegment(1);
        $router = service('router');
        $this->defData = ['config' => $this->config,
            'logged_in_user' => $this->logged_in_user,
            'backConfig' => $this->backConfig,
            'navigation' => $this->commonModel->getList('auth_permissions_pages', ['inNavigation' => true]),
            'title'=>$this->commonModel->getOne('auth_permissions_pages', ['className' => $router->controllerName(), $router->methodName(), 'methodName' => $router->controllerName(), $router->methodName()], ['projection' => ['pagename' => true]]),
            'uri' => $uri];
    }

}
