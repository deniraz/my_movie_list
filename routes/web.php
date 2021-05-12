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

//auth

// Auth route group
$router->group(['prefix' => 'auth'], function () use ($router) {
    // Matches "/auth/register
    $router->post('register', 'AuthController@register');

    // Matches "/auth/login
    $router->post('login', 'AuthController@login');

    // Matches "/auth/logout
    $router->post('logout', 'AuthController@logout');

    // Matches "/auth/profile
    $router->get('profile', 'UserController@profile');

    // Matches "/auth/users/1 
    //get one user by id
    $router->get('users/{id}', 'UserController@singleUser');

    // Matches "/auth/users
    $router->get('users', 'UserController@allUsers');
 
 });

$router->get("/user_movie", "UserController@showMovie");
$router->get("/watching", "UserController@showWatchingList");
$router->get("/watched", "UserController@showWatchedList");

$router->post("/add", "UserController@addMovie");
$router->delete("/delete", "UserController@deleteMovie");
$router->put("/edit", "UserController@changeListCategory");