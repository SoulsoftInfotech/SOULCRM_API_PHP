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


$routes->group(
    "api/org",
    function ($routes) {

        $routes->post('getdts', 'Api\org\OrganizationController::getorgdtls');
    }
);


$routes->group(
    "api/users",
    function ($routes) {

        $routes->post('createuser', 'Api\User\UserLogin::create');
        $routes->post('login', 'Api\User\UserLogin::login');
    }
);

$routes->group('api/users', ['filter' => 'authFilter'], function ($routes) {
    $routes->post('getallemp', 'Api\User\UserLogin::getAllEmployee');
    $routes->post('update/(:segment)', 'Api\User\UserLogin::update/$1');
    $routes->post('deleteemp/(:segment)', 'Api\User\UserLogin::deleteemp/$1');
    $routes->post('getemp_by_id/(:num)', 'Api\User\UserLogin::getEmpById/$1');
});

$routes->group(
    "api/leads",
    ['filter' => 'authFilter'],
    function ($routes) {

        //-----------------------------create ,update,upload-----------------------//
        $routes->post('save', 'Api\Lead\CreateLeadController::create');
        $routes->post('leadsandcust', 'Api\Lead\CreateLeadController::getAllLeadswithCustomer');
        $routes->post('leads', 'Api\Lead\CreateLeadController::getAllLeads');
        $routes->post('lead/(:num)', 'Api\Lead\CreateLeadController::getLeadById/$1');
        $routes->post('update/(:num)', 'Api\Lead\CreateLeadController::update/$1');
        $routes->post('upload', 'Api\Lead\CreateLeadController::itemExcelUpload');
        $routes->post('customers', 'Api\Lead\CreateLeadController::getAllCustomers');
        $routes->post('customer/(:num)', 'Api\Lead\CreateLeadController::updateWithCustomer/$1');
        $routes->post('getleadtype', 'Api\Lead\CreateLeadController::leadOptions');


        //--------------------------get data of all types of booking -------------//
        $routes->post('booking', 'Api\Lead\CreateLeadController::getAllBookingDone');
        $routes->post('customer', 'Api\Lead\CreateLeadController::getAllCustomer');
        $routes->post('dataentry', 'Api\Lead\CreateLeadController::getAllDataEntry');
        $routes->post('visitrequired', 'Api\Lead\CreateLeadController::getAllVisitRequired');
        $routes->post('installations', 'Api\Lead\CreateLeadController::getAllInstallation');
        $routes->post('potentials', 'Api\Lead\CreateLeadController::getAllPotential');
        $routes->post('demo', 'Api\Lead\CreateLeadController::getAllDemo');
        $routes->post('callback', 'Api\Lead\CreateLeadController::getAllCallBack');
        $routes->post('notinterested', 'Api\Lead\CreateLeadController::getAllNotInterested');


        // -------------------------------count of lead types------------------------//
        $routes->post('countlead', 'Api\Lead\CreateLeadController::countLeadstype');
        $routes->post('countpotential', 'Api\Lead\CreateLeadController::countPotentialtype');
        $routes->post('countinstallation', 'Api\Lead\CreateLeadController::countInstallationtype');
        $routes->post('countbookingdone', 'Api\Lead\CreateLeadController::countBookingDonetype');

        //---------------------------------count of all leads types---------------------//
        $routes->post('countofall', 'Api\Lead\CreateLeadController::countAllTypes');


        //----------------------------------------followup data-------------------------//
        $routes->post('followup/(:num)', 'Api\Lead\CreateLeadController::followUpData/$1');
    }
);

$routes->group('api/products', ['filter' => 'authFilter'], function ($routes) {
    $routes->post('create', 'Api\Product\ProductController::createProduct');
    $routes->post('update/(:num)', 'Api\Product\ProductController::updateProduct/$1');
    $routes->post('getall', 'Api\Product\ProductController::getAllProduct');
    $routes->post('delete/(:num)', 'Api\Product\ProductController::deleteProduct/$1');
});


//-----------------------------Campaign Assignment------------------------
$routes->group('api/assign', ['filter' => 'authFilter'], function ($routes) {
    $routes->post('camp', 'Api\Assignment\AssignmentController::assignmentCampaign');
});


//---------------------------Campaign Creation --------------------------------

$routes->group('api/campaign', ['filter' => 'authFilter'], function ($routes) {
    $routes->post('create', 'Api\Campaign\CampaignController::createCampaign');
    $routes->post('update/(:num)', 'Api\Campaign\CampaignController::updateCampaign/$1');
    $routes->post('getall', 'Api\Campaign\CampaignController::getAllCampaign');
    $routes->post('delete/(:num)', 'Api\Campaign\CampaignController::deleteCampaign/$1');
});
