<?php

use App\Http\Controllers\RoleUserController;
use App\Models\User;
use App\Models\Layanan;

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
    return 'hello world';
});

$router->get('/users' , function () use ($router) {
    $users = User::all();

    return response()->json($users);
});

$router->group(['prefix' => 'dashboard'] , function() use ($router) {
    $router->get('/role', 'RoleUserController@index');
    $router->get('/role/{id}', 'RoleUserController@show');
    $router->post('/role/create', 'RoleUserController@store');
    $router->post('/role/update/{id}', 'RoleUserController@update');
    $router->delete('/role/delete/{id}', 'RoleUserController@destroy');
});

$router->group(['prefix'=> 'auth' ], function () use ($router) {
    $router->post('/login' , 'AuthController@login');
    $router->post('/register' , 'AuthController@register');

});