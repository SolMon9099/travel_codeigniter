<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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

// Home 
$routes->get('/', 'Home::login');
$routes->get('login', 'Home::login');
$routes->post('postLogin', 'Home::postLogin');
$routes->get('logout', 'Home::logout');
$routes->get('profile', 'Home::profile', ['filter' => 'authGuard']);
$routes->get('privacy_policy', 'Home::privacy_policy');

// Dashboard
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'authGuard']);

// Customer
$routes->get('customer', 'CustomerController::index', ['filter' => 'authGuard']);
$routes->get('customer_add', 'CustomerController::add_form', ['filter' => 'authGuard']); 
$routes->post('save_customer', 'CustomerController::save_add', ['filter' => 'authGuard']); 
$routes->get('update_customer/(:num)', 'CustomerController::update_form/$1', ['filter' => 'authGuard']); 
$routes->post('save_update_customer/(:num)', 'CustomerController::save_update/$1', ['filter' => 'authGuard']); 
$routes->get('delete_customer/(:num)', 'CustomerController::delete_customer/$1', ['filter' => 'authGuard']);

// Car
$routes->get('car', 'CarController::index', ['filter' => 'authGuard']);
$routes->get('car_add', 'CarController::add_form', ['filter' => 'authGuard']); 
$routes->post('save_car', 'CarController::save_add', ['filter' => 'authGuard']); 
$routes->get('update_car/(:num)', 'CarController::update_form/$1', ['filter' => 'authGuard']); 
$routes->post('save_update_car/(:num)', 'CarController::save_update/$1', ['filter' => 'authGuard']); 
$routes->get('delete_car/(:num)', 'CarController::delete_car/$1', ['filter' => 'authGuard']);
$routes->get('delete_car_photo/(:num)', 'CarController::delete_car_photo/$1', ['filter' => 'authGuard']);

// Package
$routes->get('package', 'PackageController::index', ['filter' => 'authGuard']);
$routes->get('package_add', 'PackageController::add_form', ['filter' => 'authGuard']); 
$routes->post('save_package', 'PackageController::save_add', ['filter' => 'authGuard']); 
$routes->get('update_package/(:num)', 'PackageController::update_form/$1', ['filter' => 'authGuard']); 
$routes->post('save_update_package/(:num)', 'PackageController::save_update/$1', ['filter' => 'authGuard']); 
$routes->get('delete_package/(:num)', 'PackageController::delete_package/$1', ['filter' => 'authGuard']);
$routes->get('delete_package_photo/(:num)', 'PackageController::delete_package_photo/$1', ['filter' => 'authGuard']);

// Souvenir
$routes->get('souvenir', 'SouvenirController::index', ['filter' => 'authGuard']);
$routes->get('souvenir_add', 'SouvenirController::add_form', ['filter' => 'authGuard']); 
$routes->post('save_souvenir', 'SouvenirController::save_add', ['filter' => 'authGuard']); 
$routes->get('update_souvenir/(:num)', 'SouvenirController::update_form/$1', ['filter' => 'authGuard']); 
$routes->post('save_update_souvenir/(:num)', 'SouvenirController::save_update/$1', ['filter' => 'authGuard']); 
$routes->get('delete_souvenir/(:num)', 'SouvenirController::delete_souvenir/$1', ['filter' => 'authGuard']);
$routes->get('delete_souvenir_photo/(:num)', 'SouvenirController::delete_souvenir_photo/$1', ['filter' => 'authGuard']);

// Hotel
$routes->get('hotel', 'HotelController::index', ['filter' => 'authGuard']);
$routes->get('hotel_add', 'HotelController::add_form', ['filter' => 'authGuard']); 
$routes->post('save_hotel', 'HotelController::save_add', ['filter' => 'authGuard']); 
$routes->get('update_hotel/(:num)', 'HotelController::update_form/$1', ['filter' => 'authGuard']); 
$routes->post('save_update_hotel/(:num)', 'HotelController::save_update/$1', ['filter' => 'authGuard']); 
$routes->get('delete_hotel/(:num)', 'HotelController::delete_hotel/$1', ['filter' => 'authGuard']);
$routes->get('delete_hotel_photo/(:num)', 'HotelController::delete_hotel_photo/$1', ['filter' => 'authGuard']);

// Staffs
$routes->get('staff', 'StaffController::index', ['filter' => 'authGuard']);
$routes->get('staff_add', 'StaffController::add_form', ['filter' => 'authGuard']); 
$routes->post('save_staff', 'StaffController::save_add', ['filter' => 'authGuard']); 
$routes->get('update_staff/(:num)', 'StaffController::update_form/$1', ['filter' => 'authGuard']); 
$routes->post('save_update_staff/(:num)', 'StaffController::save_update/$1', ['filter' => 'authGuard']); 
$routes->get('delete_staff/(:num)', 'StaffController::delete_staff/$1', ['filter' => 'authGuard']); 

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
