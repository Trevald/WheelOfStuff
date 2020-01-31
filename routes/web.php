<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/*
$router->get('/', function () use ($router) {
    return $router->app->version();
});
*/

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('wheel/{guid}', 'WheelController@show');
    $router->post('wheel', 'WheelController@create');
    // $router->put('wheel/{guid}', 'WheelController@update');
});

$router->get('/{route:.*}/', function ()  {
    return view('app');
});