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
$routes->group("api/orgs",function($routes){

    $routes->post('orgcode','Api\User\UserLogin::checkauthcode');
    
});
$routes->group("api/leads", ['filter' => 'authFilter'],function($routes){
     
    //-----------------------------create ,update,upload-----------------------//
    $routes->post('save','Api\Lead\CreateLeadController::create');
    $routes->get('leadsandcust','Api\Lead\CreateLeadController::getAllLeadswithCustomer');
    $routes->get('leads','Api\Lead\CreateLeadController::getAllLeads');
    $routes->get('lead/(:num)','Api\Lead\CreateLeadController::getLeadById/$1');
    $routes->post('update/(:num)','Api\Lead\CreateLeadController::update/$1');
    $routes->post('upload','Api\Lead\CreateLeadController::itemExcelUpload');
    $routes->get('customers','Api\Lead\CreateLeadController::getAllCustomers');
    $routes->post('customer/(:num)','Api\Lead\CreateLeadController::updateWithCustomer/$1');
    $routes->get('getleadtype','Api\Lead\CreateLeadController::leadOptions');


    //--------------------------get data of all types of booking -------------//
    $routes->get('booking','Api\Lead\CreateLeadController::getAllBookingDone');
    $routes->get('customer','Api\Lead\CreateLeadController::getAllCustomer');
    $routes->get('dataentry','Api\Lead\CreateLeadController::getAllDataEntry');
    $routes->get('visitrequired','Api\Lead\CreateLeadController::getAllVisitRequired');
    $routes->get('installations','Api\Lead\CreateLeadController::getAllInstallation');
    $routes->get('potentials','Api\Lead\CreateLeadController::getAllPotential');
    $routes->get('demo','Api\Lead\CreateLeadController::getAllDemo');
    $routes->get('callback','Api\Lead\CreateLeadController::getAllCallBack');
    $routes->get('notinterested','Api\Lead\CreateLeadController::getAllNotInterested');


    // -------------------------------count of lead types------------------------//
    $routes->get('countlead','Api\Lead\CreateLeadController::countLeadstype');
    $routes->get('countpotential','Api\Lead\CreateLeadController::countPotentialtype');
    $routes->get('countinstallation','Api\Lead\CreateLeadController::countInstallationtype');
    $routes->get('countbookingdone','Api\Lead\CreateLeadController::countBookingDonetype');

    //---------------------------------count of all leads types---------------------//
    $routes->get('countofall','Api\Lead\CreateLeadController::countAllTypes');
}
);


