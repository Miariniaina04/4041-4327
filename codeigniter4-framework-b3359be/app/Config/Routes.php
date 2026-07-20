<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'ClientController::login');
      

