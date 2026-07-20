<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection
 */
$routes->get('/', 'Home::index');

$routes->get('/client/dashboard', 'ClientController::dashboard');
$routes->post('/login', 'ClientController::login');
$routes->get('/client/operation', 'OperationController::index'); 
$routes->get('/client/operation/calcul-frais-ajax', 'OperationController::obtenirCalculFraisAjax');
$routes->get('/client/transaction', 'TransactionController::index'); 
$routes->post('/client/transaction/effectuer', 'TransactionController::save');

$routes->get('/operateur', 'OperateurController::index');
$routes->get('/operateur/show/(:num)', 'OperateurController::show/$1');
$routes->get('/operateur/createPrefixe', 'OperateurController::createPrefixe');
$routes->post('/operateur/storePrefixe', 'OperateurController::storePrefixe');
$routes->get('/operateur/editBareme/(:num)', 'OperateurController::editBareme/$1');
$routes->post('/operateur/updateBareme/(:num)', 'OperateurController::updateBareme/$1');
$routes->get('/operateur/desactiverPrefixe/(:num)', 'OperateurController::desactiverPrefixe/$1');
$routes->get('/operateur/deleteBareme/(:num)', 'OperateurController::deleteBareme/$1');



