<?php

/**
 * Define Users Routes
 */

$routes->group('backend', ['namespace' => 'Modules\Backend\Controllers'], function ($routes) {
    $routes->get('403', 'Errors::error_403', ['filter' => 'backendAfterLoginFilter']);

    // Login/out
    $routes->get('login', 'Auth\AuthController::login', ['filter' => 'backendAuthFilter','as'=>'login']);
    $routes->post('login', 'Auth\AuthController::attemptLogin',['filter' => 'backendAuthFilter']);
    $routes->get('logout', 'Auth\AuthController::logout',['filter' => 'backendAuthFilter','as'=>'logout']);

    // Activation
    $routes->get('activate-account/(:any)', 'Auth\AuthController::activateAccount/$1', ['filter' => 'backendAuthFilter','as'=>'activate-account']);
    $routes->get('activate-email/(:any)', 'Auth\AuthController::activateEmail/$1', ['filter' => 'backendAuthFilter','as'=>'activate-email']);

    // Forgot/Resets
    $routes->get('forgot', 'Auth\AuthController::forgotPassword', ['filter' => 'backendAuthFilter','as'=>'forgot']);
    $routes->post('forgot', 'Auth\AuthController::attemptForgot',['filter' => 'backendAuthFilter']);
    $routes->get('reset-password/(:any)', 'Auth\AuthController::resetPassword/$1', ['filter' => 'backendAuthFilter','as'=>'reset-password']);
    $routes->post('reset-password/(:any)', 'Auth\AuthController::attemptReset/$1',['filter' =>'backendAfterLoginFilter']);

    $routes->get('/', 'Backend::index', ['filter' => 'backendAfterLoginFilter']);

    // Users Module
    $routes->group('officeWorker',function($routes){
        $routes->get('(:num)', 'UsersCrud\UserController::officeWorker/$1', ['as' => 'officeWorker', 'filter' => 'backendAfterLoginFilter']);
        $routes->get('create_user', 'UsersCrud\UserController::create_user', ['as' => 'create_user', 'filter' => 'backendAfterLoginFilter']);
        $routes->post('create_user', 'UsersCrud\UserController::create_user_post', ['filter' => 'backendAfterLoginFilter']);
        $routes->get('update_user/(:any)', 'UsersCrud\UserController::update_user/$1', ['filter' => 'backendAfterLoginFilter', 'as' => 'update_user']);
        $routes->post('update_user/(:any)', 'UsersCrud\UserController::update_user_post/$1', ['filter' => 'backendAfterLoginFilter']);
        $routes->get('user_del/(:any)', 'UsersCrud\UserController::user_del/$1', ['filter' => 'backendAfterLoginFilter','as'=>'user_del']);
        $routes->post('blackList', 'UsersCrud\UserController::ajax_blackList_post', ['filter' => 'backendAfterLoginFilter']);
        $routes->post('removeFromBlacklist', 'UsersCrud\UserController::ajax_remove_from_blackList_post', ['filter' => 'backendAfterLoginFilter']);
        $routes->post('forceResetPassword', 'UsersCrud\UserController::ajax_force_reset_password', ['filter' => 'backendAfterLoginFilter']);
        $routes->get('user_perms/(:any)', 'PermGroup\PermgroupController::user_perms/$1', ['filter' => 'backendAfterLoginFilter', 'as' => 'user_perms']);
        $routes->post('user_perms/(:any)', 'PermGroup\PermgroupController::user_perms_post/$1', ['filter' => 'backendAfterLoginFilter']);

        $routes->get('groupList/(:num)', 'PermGroup\PermgroupController::groupList/$1', ['as' => 'groupList', 'filter' => 'backendAfterLoginFilter']);
        $routes->get('group_create', 'PermGroup\PermgroupController::group_create', ['as' => 'group_create', 'filter' => 'backendAfterLoginFilter']);
        $routes->post('group_create', 'PermGroup\PermgroupController::group_create_post', ['filter' => 'backendAfterLoginFilter']);
        $routes->get('group_update/(:any)', 'PermGroup\PermgroupController::group_update/$1', ['filter' => 'backendAfterLoginFilter', 'as' => 'group_update']);
        $routes->post('group_update/(:any)', 'PermGroup\PermgroupController::group_update_post/$1', ['filter' => 'backendAfterLoginFilter','as'=>'group_update']);
    });

    $routes->get('profile', 'UsersCrud\UserController::profile', ['filter' => 'backendAfterLoginFilter','as'=>'profile']);
    $routes->post('profile', 'UsersCrud\UserController::profile_post', ['filter' => 'backendAfterLoginFilter']);

    //setting module
    $routes->group('settings', function ($routes) {
        $routes->get('/','Settings::index',['as'=>'settings','filter' => 'backendAfterLoginFilter']);
        $routes->post('compInfos','Settings::compInfosPost',['as'=>'compInfosPost','filter' => 'backendAfterLoginFilter']);
        $routes->post('socialMedia','Settings::socialMediaPost',['as'=>'socialMediaPost','filter' => 'backendAfterLoginFilter']);
        $routes->post('mailSettings','Settings::mailSettingsPost',['as'=>'mailSettingsPost','filter' => 'backendAfterLoginFilter']);
    });
    // Other Pages
});
