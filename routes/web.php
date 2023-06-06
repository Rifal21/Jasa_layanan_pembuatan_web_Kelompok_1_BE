<?php


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

$router->get('/layanan' , function () use ($router) {
    $layanan = Layanan::all();

    return response()->json($layanan);
});

$router->group(['prefix'=> 'auth' ], function () use ($router) {
    $router->post('/login' , 'AuthController@login');
    $router->post('/register' , 'AuthController@register');

});