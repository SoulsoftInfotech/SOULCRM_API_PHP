<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->group("api/users", function($routes){

    $routes->post('createuser','Api\User\UserLogin::create');
    $routes->post('login','Api\User\UserLogin::login');
}
);
$routes->group("api/leads", function($routes){
     
    $routes->post('createlead','Api\Lead\CreateLeadController::create');
    $routes->get('leadsandcust','Api\Lead\CreateLeadController::getAllLeadswithCustomer');
    $routes->get('leads','Api\Lead\CreateLeadController::getAllLeads');
    $routes->get('lead/(:num)','Api\Lead\CreateLeadController::getLeadById/$1');
    $routes->get('update/(:num)','Api\Lead\CreateLeadController::update/$1');
    $routes->post('upload','Api\Lead\CreateLeadController::itemExcelUpload');
    $routes->get('customers','Api\Lead\CreateLeadController::getAllCustomers');
    $routes->post('customer/(:num)','Api\Lead\CreateLeadController::updateWithCustomer/$1');
}
);

