<?php
use Illuminate\Support\Str;

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

$router->post("/register", "AuthController@register");
$router->post("/login", "AuthController@login");

$router->get("/user", "UserController@index");

$router->get("/user_movie", "UserController@showMovie");
$router->get("/watching", "UserController@showWatchingList");
$router->get("/watched", "UserController@showWatchedList");

$router->post("/add", "UserController@addMovie");
$router->get("/delete", "UserController@deleteMovie");
$router->get("/edit", "UserController@changeListCategory");