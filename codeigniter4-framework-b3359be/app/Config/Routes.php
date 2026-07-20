<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection
 */
$routes->get('/', 'Home::index');

$routes->get('/client/dashboard', 'ClientController::dashboard');
$routes->post('/login', 'ClientController::login');


