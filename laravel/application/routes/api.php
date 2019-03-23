<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth, login and token.
Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('user', 'AuthController@user');
    Route::get('token', 'AuthController@respondTokenStatus');
});
// Todo list
Route::group([
    'prefix' => 'todolist',
    'middleware' => 'jwt.auth'
], function ($router) {
    // Get todo tasks or specific id.
    Route::get('/{id?}', 'TodoListController@index');
    // Create a new task into todo list.
    Route::post('/', 'TodoListController@create');
    // Update a task by id.
    Route::put('/{id}', 'TodoListController@update');
    // Delete a task or all tasks.
    Route::delete('/{id?}', 'TodoListController@destroy');
});

