<?php

/**
 * Define Users Routes
 */

$routes->group('installation', ['namespace' => 'Modules\Installation\Controllers'], function ($routes) {
    $routes->get('/', 'Installation::index');
    $routes->post('install', 'Installation::installation_post', ['as' => 'install']);
});
