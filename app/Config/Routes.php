<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ================= LOGIN =================
$routes->group('', ['filter' => 'noauth'], function ($routes) {
    $routes->get('/',           'AuthController::login');
    $routes->get('login',       'AuthController::login');
    $routes->post('auth',       'AuthController::authenticate');
});

// ================= DASHBOARD USER =================
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'AppController::index');
    $routes->post('logout', 'AuthController::logout');

});
