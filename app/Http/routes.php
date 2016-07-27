<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//DASHBOARD
Route::get('/', 'UserController@index');
Route::post('/login', 'UserController@login');
Route::post('/register', 'UserController@store');
Route::get('/dashboard', 'UserController@dashboard');

//API
Route::post('api/v1/auth/login', ['uses' => 'Auth\AuthController@login']);
Route::post('/api/v1/register', 'UserAPIController@create');
Route::get('/api/v1/users', 'UserAPIController@getAllUsers');
Route::get('/api/v1/user/{id}', 'UserAPIController@getUserById');
