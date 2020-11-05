<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');
$router->post('/refresh', 'AuthController@refresh');
$router->post('/logout', 'AuthController@logout');
$router->get('/dashboard', 'Attendance@dashboard');
$router->post('/dashboard/register', 'Attendance@register');

$router->group(['prefix' => 'organizer'], function () use ($router) {
    $router->post('/register', 'AuthOrganizerController@register');
    $router->post('/login', 'AuthOrganizerController@login');
    $router->post('/logout', 'AuthOrganizerController@logout');
    $router->post('/event', 'OrganizerController@addEvent');
    $router->get('/event', 'OrganizerController@myEvent');
    $router->get('/event/{id}', 'OrganizerController@detailEvent');
});

