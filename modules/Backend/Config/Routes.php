<?php

/**
 * Define Users Routes
 */
$routes->get('backend/403', '\Modules\Backend\Controllers\Errors::error_403', ['filter' => 'afterLoginFilter', 'as' => '403']);

$routes->group('backend', ['namespace' => 'Modules\Backend\Controllers'], function ($routes) {
    $routes->get('/', 'Backend::index', ['filter' => 'afterLoginFilter']);
    $routes->get('officeWorker/(:num)', 'UsersCrud\UserController::officeWorker/$1', ['as' => 'officeWorker', 'filter' => 'afterLoginFilter']);
    $routes->get('create_user', 'UsersCrud\UserController::create_user', ['as' => 'create_user', 'filter' => 'afterLoginFilter']);
    $routes->post('create_user', 'UsersCrud\UserController::create_user_post', ['filter' => 'afterLoginFilter']);
    $routes->get('groupList/(:num)', 'PermGroup\PermgroupController::groupList/$1', ['as' => 'groupList', 'filter' => 'afterLoginFilter']);
    $routes->get('group_create', 'PermGroup\PermgroupController::group_create', ['as' => 'group_create', 'filter' => 'afterLoginFilter']);
    $routes->post('group_create', 'PermGroup\PermgroupController::group_create_post', ['filter' => 'afterLoginFilter']);
    $routes->get('group_update/(:any)', 'PermGroup\PermgroupController::group_update/$1', ['filter' => 'afterLoginFilter', 'as' => 'group_update']);
    $routes->post('group_update/(:any)', 'PermGroup\PermgroupController::group_update_post/$1', ['filter' => 'afterLoginFilter']);
    $routes->get('user_perms/(:any)', 'PermGroup\PermgroupController::user_perms/$1', ['filter' => 'afterLoginFilter', 'as' => 'user_perms']);
    $routes->post('user_perms/(:any)', 'PermGroup\PermgroupController::user_perms_post/$1', ['filter' => 'afterLoginFilter']);
    $routes->get('update_user/(:any)', 'UsersCrud\UserController::update_user/$1', ['filter' => 'afterLoginFilter', 'as' => 'update_user']);
    $routes->post('update_user/(:any)', 'UsersCrud\UserController::update_user_post/$1', ['filter' => 'afterLoginFilter']);
    $routes->get('profile', 'UsersCrud\UserController::profile', ['filter' => 'afterLoginFilter', 'as' => 'profile']);
    $routes->post('profile', 'UsersCrud\UserController::profile_post', ['filter' => 'afterLoginFilter']);
    $routes->post('blackList', 'UsersCrud\UserController::ajax_blackList_post', ['filter' => 'afterLoginFilter','as'=>'blackList']);
    $routes->post('removeFromBlacklist', 'UsersCrud\UserController::ajax_remove_from_blackList_post', ['filter' => 'afterLoginFilter','as'=>'removeFromBlacklist']);
    $routes->post('forceResetPassword', 'UsersCrud\UserController::ajax_force_reset_password', ['filter' => 'afterLoginFilter','as'=>'forceResetPassword']);
});
