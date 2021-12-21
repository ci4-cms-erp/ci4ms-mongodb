<?php
$routes->group('forms', ['namespace' => '\App\Controllers\templates\default'], function ($routes) {
    $routes->post('contactForm', 'Forms::contactForm_post',['as'=>'contactForm']);
});