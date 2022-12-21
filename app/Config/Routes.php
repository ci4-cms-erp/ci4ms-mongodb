<?php namespace Config;

// Create a new instance of our RouteCollection class.
use ci4mongodblibrary\Models\CommonModel;

$commonModel = new CommonModel();
$activeTemplate=$commonModel->getOne('settings');

$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {require SYSTEMPATH . 'Config/Routes.php';}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
//$routes->setAutoRoute(true);
$routes->set404Override('App\Controllers\Errors::error404');

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index',['filter'=>'ci4ms']);
$routes->get('maintenance-mode','Home::maintenanceMode',['as'=>'maintenance-mode']);
$routes->get('blog','Home::blog',['filter'=>'ci4ms']);
$routes->get('blog/(:num)','Home::blog/$1',['filter'=>'ci4ms']);
$routes->get('blog/(:any)','Home::blogDetail/$1',['filter'=>'ci4ms']);
$routes->get('tag/(:any)','Home::tagList/$1',['filter'=>'ci4ms','as'=>'tag']);
$routes->get('category/(:any)','Home::category/$1',['filter'=>'ci4ms','as'=>'category']);
$routes->post('newComment','Home::newComment',['filter'=>'ci4ms','as'=>'newComment']);
$routes->post('repliesComment','Home::repliesComment',['filter'=>'ci4ms','as'=>'repliesComment']);
$routes->post('loadMoreComments','Home::loadMoreComments',['filter'=>'ci4ms','as'=>'loadMoreComments']);

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';

/**
 * --------------------------------------------------------------------
 * Include Templates Routes Files
 * --------------------------------------------------------------------
 */
if (is_dir(APPPATH.'Config')) {
    $modulesPath = APPPATH.'Config';
    $modules = scandir($modulesPath.'/templates');
    foreach ($modules as $module) {
        if ($module === '.' || $module === '..') continue;
        if (is_dir($modulesPath) . '/' . $module) {
            $routesPath = $modulesPath . '/templates/'.$activeTemplate->templateInfos->path.'/Routes.php';
            if (is_file($routesPath)) require($routesPath);
            else continue;
        }
    }
}

/**
 * --------------------------------------------------------------------
 * Include Modules Routes Files
 * --------------------------------------------------------------------
 */
if (is_dir(ROOTPATH.'modules')) {
    $modulesPath = ROOTPATH.'modules/';
    $modules = scandir($modulesPath);

    foreach ($modules as $module) {
        if ($module === '.' || $module === '..') continue;
        if (is_dir($modulesPath) . '/' . $module) {
            $routesPath = $modulesPath . $module . '/Config/Routes.php';
            if (is_file($routesPath)) require($routesPath);
            else continue;
        }
    }
}

$routes->get('/(:any)', 'Home::index/$1',['filter'=>'ci4ms']);