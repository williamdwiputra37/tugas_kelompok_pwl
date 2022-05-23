<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// Custom Routes
$routes->post('/auth/login', 'Auth::login');
$routes->post('/auth/register', 'Auth::register');
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'authGuard']);
$routes->get('/error-permission', 'ErrorPermission::index');

$routes->group('admin', ['filter' => ['authGuard','adminGuard']], function ($routes) {    
    $routes->get('dashboard', 'Admin::index');
    $routes->get('books', 'Admin::books');
    $routes->group('categories', function ($routes) {
        $routes->get('list', 'Categories::index');
        $routes->get('create', 'Categories::create');
        $routes->get('edit/(:any)', 'Categories::edit/$1');
        $routes->get('delete/(:any)', 'Categories::delete_category/$1');
        $routes->post('save_category', 'Categories::save_category');
        $routes->post('update_category', 'Categories::update_category');
    });
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
