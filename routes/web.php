<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('users', ['uses' => 'UsersController@index']);
Route::get('users/create', ['uses' => 'UsersController@create']);
Route::post('users', ['uses' => 'UsersController@store']);
Auth::routes();

//Default
Route::get('/home', 'HomeController@index');
Route::post('/home', 'HomeController@index');

//Events
Route::post('/createevent', 'EventController@index');
Route::post('/eventcreated', 'EventController@create');
Route::post('/deleteevent', 'EventController@delete');

Route::get('/createloc', 'CreateLocController@index');
Route::post('/createloc', 'CreateLocController@create');

//RSOs
Route::post('/rsocreated', 'RsoController@create');
Route::get('/joinrso', 'RsoController@join');
Route::post('/rsojoined', 'RsoController@joined');
Route::get('/createrso', 'RsoController@start');
Route::post('/leaveRso', 'RsoController@leaverso');






