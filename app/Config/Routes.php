<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

/*
 * Modules
 */
$routes->get('modules', 'Modules::index');
$routes->post('create-module', 'Modules::create');
$routes->post('update-module/(:num)', 'Modules::update/$1');
$routes->get('delete-module/(:num)', 'Modules::delete/$1');
$routes->get('get-module-by-id/(:num)', 'Modules::getByID/$1');

/*
 * Pages
 */
$routes->match(['get', 'post'], 'login', 'Pages::login');
$routes->get('logout', 'Pages::logout');

/*
 * Permissions
 */
$routes->get('permissions', 'Permissions::index');
$routes->post('create-permission', 'Permissions::create');
$routes->post('update-permission/(:num)', 'Permissions::update/$1');
$routes->get('delete-permission/(:num)', 'Permissions::delete/$1');
$routes->get('get-permission-by-id/(:num)', 'Permissions::getByID/$1');

/*
 * Roles
 */
$routes->get('roles', 'Roles::index');
$routes->post('create-role', 'Roles::create');
$routes->post('update-role/(:num)', 'Roles::update/$1');
$routes->get('delete-role/(:num)', 'Roles::delete/$1');
$routes->get('get-role-by-id/(:num)', 'Roles::getByID/$1');

/*
 * Transaction Groups
 */
$routes->get('transaction-groups', 'TransactionGroups::index');
$routes->post('create-transaction-group', 'TransactionGroups::create');
$routes->post('update-transaction-group/(:num)', 'TransactionGroups::update/$1');
$routes->get('delete-transaction-group/(:num)', 'TransactionGroups::delete/$1');
$routes->get('get-transaction-group-by-id/(:num)', 'TransactionGroups::getByID/$1');

/*
 * Transactions
 */
$routes->get('transactions', 'Transactions::index');
$routes->post('create-transaction', 'Transactions::create');
$routes->post('update-transaction/(:num)', 'Transactions::update/$1');
$routes->get('delete-transaction/(:num)', 'Transactions::delete/$1');
$routes->get('get-transaction-by-id/(:num)', 'Transactions::getByID/$1');

/*
 * TransactionTypes
 */
$routes->get('transaction-types', 'TransactionTypes::index');
$routes->post('create-transaction-type', 'TransactionTypes::create');
$routes->post('update-transaction-type/(:num)', 'TransactionTypes::update/$1');
$routes->get('delete-transaction-type/(:num)', 'TransactionTypes::delete/$1');
$routes->get('get-transaction-type-by-id/(:num)', 'TransactionTypes::getByID/$1');

/*
 * Users
 */
$routes->get('users', 'Users::index');
$routes->post('create-user', 'Users::create');
$routes->post('update-user/(:num)', 'Users::update/$1');
$routes->get('delete-user/(:num)', 'Users::delete/$1');
$routes->get('get-user-by-id/(:num)', 'Users::getByID/$1');