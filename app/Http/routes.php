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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/discs', 'DiscController@index');
//Route::post('/disc', 'DiscController@store');
//Route::delete('/disc/{disc}', 'DiscController@destroy');

Route::get('/groups', 'GroupController@index');
Route::get('/groups/{id}', [
	'as'   => 'groups.groupInfo',
	'uses' =>'GroupController@groupInfo'
]);

