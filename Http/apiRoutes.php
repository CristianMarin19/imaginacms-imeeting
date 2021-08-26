<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/imeeting/v1'], function (Router $router) {

    
    //======  Meetings
    require('ApiRoutes/meetingRoutes.php');
    

    $router->apiCrud([
      'module' => 'imeeting',
      'prefix' => 'providers',
      'controller' => 'ProviderApiController',
      'middleware' => ['index' => []] // Just Testing
    ]);
// append

});