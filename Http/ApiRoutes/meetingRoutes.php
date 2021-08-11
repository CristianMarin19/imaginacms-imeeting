<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/meetings'], function (Router $router) {
  

  $locale = \LaravelLocalization::setLocale() ?: \App::getLocale();
  
  $router->post('/', [
    'as' => $locale . 'api.imeeting.meetings.create',
    'uses' => 'MeetingApiController@create',
  ]);
  $router->get('/', [
    'as' => $locale . 'api.imeeting.meetings.index',
    'uses' => 'MeetingApiController@index',
  ]);
  $router->get('/{criteria}', [
    'as' => $locale . 'api.imeeting.meetings.show',
    'uses' => 'MeetingApiController@show',
  ]);
  $router->put('/{criteria}', [
    'as' => $locale . 'api.imeeting.meetings.update',
    'uses' => 'MeetingApiController@update',
  ]);

  $router->delete('/{criteria}', [
    'as' => $locale . 'api.imeeting.meetings.delete',
    'uses' => 'MeetingApiController@delete',
  ]);
 
});
