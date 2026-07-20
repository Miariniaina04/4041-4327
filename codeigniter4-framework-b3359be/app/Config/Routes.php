<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection
 */
$routes->get('/', 'Home::index');
$routes->get('/log', 'Home::log');      
$routes->get('/inscription', 'Home::insc');

