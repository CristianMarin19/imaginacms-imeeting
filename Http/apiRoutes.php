<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/imeeting/v1'], function (Router $router) {

    $router->apiCrud([
      'module' => 'imeeting',
      'prefix' => 'meetings',
      'controller' => 'MeetingApiController',
      'middleware' => [] 
    ]);
    
    $router->apiCrud([
      'module' => 'imeeting',
      'prefix' => 'providers',
      'controller' => 'ProviderApiController',
      'middleware' => []
    ]);
// append

});