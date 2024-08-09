<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

// $routes->group("api/users",['filter' => 'authFilter'], function($routes){

//     $routes->post('createuser','Api\User\UserLogin::create');
//     $routes->post('login','Api\User\UserLogin::login');
// }
// );



$routes->group("api/users",function($routes){

    $routes->post('createuser','Api\User\UserLogin::create');
    $routes->post('login','Api\User\UserLogin::login');
}
);
$routes->group("api/leads", ['filter' => 'authFilter'],function($routes){
     
    $routes->post('save','Api\Lead\CreateLeadController::create');
    $routes->get('leadsandcust','Api\Lead\CreateLeadController::getAllLeadswithCustomer');
    $routes->get('leads','Api\Lead\CreateLeadController::getAllLeads');
    $routes->get('lead/(:num)','Api\Lead\CreateLeadController::getLeadById/$1');
    $routes->post('update/(:num)','Api\Lead\CreateLeadController::update/$1');
    $routes->post('upload','Api\Lead\CreateLeadController::itemExcelUpload');
    $routes->get('customers','Api\Lead\CreateLeadController::getAllCustomers');
    $routes->post('customer/(:num)','Api\Lead\CreateLeadController::updateWithCustomer/$1');
    $routes->get('getleadtype','Api\Lead\CreateLeadController::leadOptions');

    $routes->get('Bookings','Api\Lead\CreateLeadController::getAllBookingDone');
    $routes->get('Customers','Api\Lead\CreateLeadController::getAllCustomer');
    $routes->get('DataEntrys','Api\Lead\CreateLeadController::getAllDataEntry');
    $routes->get('VisitRequired','Api\Lead\CreateLeadController::getAllVisitRequired');
    $routes->get('Installations','Api\Lead\CreateLeadController::getAllInstallation');
    $routes->get('Potentials','Api\Lead\CreateLeadController::getAllPotential');
    $routes->get('Demo','Api\Lead\CreateLeadController::getAllDemo');
    $routes->get('CallBack','Api\Lead\CreateLeadController::getAllCallBack');
    $routes->get('NotInterested','Api\Lead\CreateLeadController::getAllNotInterested');
}
);


