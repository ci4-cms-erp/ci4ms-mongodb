<?php

/**
 * Define Users Routes
 */

$routes->group('backend', ['namespace' => 'Modules\Backend\Controllers'], function ($routes) {
    $routes->get('403', 'Errors::error_403', ['filter' => 'backendAfterLoginFilter']);

    // Login/out
    $routes->get('login', 'Auth\AuthController::login', ['filter' => 'backendAuthFilter']);
    $routes->post('login', 'Auth\AuthController::attemptLogin');
    $routes->get('logout', 'Auth\AuthController::logout');

    // Activation
    $routes->get('activate-account/(:any)', 'Auth\AuthController::activateAccount/$1', ['filter' => 'backendAuthFilter']);
    $routes->get('activate-email/(:any)', 'Auth\AuthController::activateEmail/$1', ['filter' => 'backendAuthFilter']);

    // Forgot/Resets
    $routes->get('forgot', 'Auth\AuthController::forgotPassword', ['filter' => 'backendAuthFilter']);
    $routes->post('forgot', 'Auth\AuthController::attemptForgot');
    $routes->get('reset-password/(:any)', 'Auth\AuthController::resetPassword/$1', ['filter' => 'backendAuthFilter']);
    $routes->post('reset-password/(:any)', 'Auth\AuthController::attemptReset/$1');

    // Users Module
    $routes->get('/', 'Backend::index', ['filter' => 'backendAfterLoginFilter']);
    $routes->get('officeWorker/(:num)', 'UsersCrud\UserController::officeWorker/$1', ['as' => 'officeWorker', 'filter' => 'backendAfterLoginFilter']);
    $routes->get('create_user', 'UsersCrud\UserController::create_user', ['as' => 'create_user', 'filter' => 'backendAfterLoginFilter']);
    $routes->post('create_user', 'UsersCrud\UserController::create_user_post', ['filter' => 'backendAfterLoginFilter']);
    $routes->get('groupList/(:num)', 'PermGroup\PermgroupController::groupList/$1', ['as' => 'groupList', 'filter' => 'backendAfterLoginFilter']);
    $routes->get('group_create', 'PermGroup\PermgroupController::group_create', ['as' => 'group_create', 'filter' => 'backendAfterLoginFilter']);
    $routes->post('group_create', 'PermGroup\PermgroupController::group_create_post', ['filter' => 'backendAfterLoginFilter']);
    $routes->get('group_update/(:any)', 'PermGroup\PermgroupController::group_update/$1', ['filter' => 'backendAfterLoginFilter', 'as' => 'group_update']);
    $routes->post('group_update/(:any)', 'PermGroup\PermgroupController::group_update_post/$1', ['filter' => 'backendAfterLoginFilter']);
    $routes->get('user_perms/(:any)', 'PermGroup\PermgroupController::user_perms/$1', ['filter' => 'backendAfterLoginFilter', 'as' => 'user_perms']);
    $routes->post('user_perms/(:any)', 'PermGroup\PermgroupController::user_perms_post/$1', ['filter' => 'backendAfterLoginFilter']);
    $routes->get('update_user/(:any)', 'UsersCrud\UserController::update_user/$1', ['filter' => 'backendAfterLoginFilter', 'as' => 'update_user']);
    $routes->post('update_user/(:any)', 'UsersCrud\UserController::update_user_post/$1', ['filter' => 'backendAfterLoginFilter']);
    $routes->get('profile', 'UsersCrud\UserController::profile', ['filter' => 'backendAfterLoginFilter']);
    $routes->post('profile', 'UsersCrud\UserController::profile_post', ['filter' => 'backendAfterLoginFilter']);
    $routes->post('blackList', 'UsersCrud\UserController::ajax_blackList_post', ['filter' => 'backendAfterLoginFilter','as'=>'blackList']);
    $routes->post('removeFromBlacklist', 'UsersCrud\UserController::ajax_remove_from_blackList_post', ['filter' => 'backendAfterLoginFilter','as'=>'removeFromBlacklist']);
    $routes->post('forceResetPassword', 'UsersCrud\UserController::ajax_force_reset_password', ['filter' => 'backendAfterLoginFilter','as'=>'forceResetPassword']);

    // Other Pages
});
