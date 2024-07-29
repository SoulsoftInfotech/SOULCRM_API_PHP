<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->group("api/users", function($routes){

    $routes->post('createuser','Api\User\UserLogin::create');
    $routes->get('login','Api\User\UserLogin::login');
}
);
$routes->group("api/leads", function($routes){
     
    $routes->post('createlead','Api\Lead\CreateLeadController::create');
    $routes->get('update','Api\Lead\CreateLeadController::update');
}
);

