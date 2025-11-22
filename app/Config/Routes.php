<?php

    use CodeIgniter\Router\RouteCollection;


    /**
     * @var RouteCollection $routes
     */

    /**
     * /
     * /blank
     * /product/:id
     */
    $routes->get('/', 'HomeController::index');
    $routes->get('/blank', 'HomeController::blank');
    $routes->get('/product/(:num)', 'ProductController::show/$1');

    /**
     * /register
     */
    $routes->get('/register', 'RegisterController::index');
    $routes->post('/register', 'RegisterController::store');

    /**
     * /login
     * /logout
     */
    $routes->get('/login', 'LoginController::index');
    $routes->post('/login', 'LoginController::auth');
    $routes->get('/logout', 'LoginController::logout');

    /**
     * /forgot
     * /reset
     */
    $routes->get('/forgot', 'PasswordController::forgot');
    $routes->post('/forgot', 'PasswordController::sendResetLink');
    $routes->get('/reset/(:segment)', 'PasswordController::reset/$1');
    $routes->post('/reset-password', 'PasswordController::updatePassword');

    /**
     * /dashboard
     */
    $routes->get('/dashboard', 'DashboardController::index');

    /**
     * /dashboard/contact
     */
    $routes->get('/dashboard/contact', 'PhoneController::index');
    $routes->post('/dashboard/contact', 'PhoneController::save');

    /**
     * /dashboard/address
     */
    $routes->get('/dashboard/address', 'AddressController::index');
    $routes->post('/dashboard/address', 'AddressController::save');

    /**
     * /dashboard/categories
     */
    $routes->group('dashboard/categories', function($routes)
    {
        $routes->get('/', 'CategoryController::index');
        $routes->get('create', 'CategoryController::create');
        $routes->post('store', 'CategoryController::store');
        $routes->get('edit/(:num)', 'CategoryController::edit/$1');
        $routes->post('update/(:num)', 'CategoryController::update/$1');
        $routes->get('delete/(:num)', 'CategoryController::delete/$1');
    });

    /**
     * dashboard
     */
    $routes->group('dashboard', ['filter' => 'auth'], static function ($routes)
    {
        /**
         * dashboard/sell
         */
        $routes->get('sell', 'SellController::index');
        $routes->post('sell/store', 'SellController::store');

        /**
         * dashboard/products
         */
        $routes->get('products', 'ProductsController::index');
        $routes->get('products/delete/(:num)', 'ProductsController::delete/$1');
    });