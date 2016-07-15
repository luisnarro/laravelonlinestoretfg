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

Route::get('/home', 'UserController@index');

Route::get('/discs', 'DiscController@index');
//Route::post('/disc', 'DiscController@store');
//Route::delete('/disc/{disc}', 'DiscController@destroy');

Route::get('/groups', 'GroupController@index');
Route::get('/groups/{id}', [
	'as'   => 'groups.groupInfo',
	'uses' =>'GroupController@groupInfo'
]);

Route::get('/artists', 'ArtistController@index');
Route::get('/artists/{id}', [
	'as'   => 'artists.artistInfo',
	'uses' =>'ArtistController@artistInfo'
]);

Route::get('/styles', 'StyleController@index');
Route::get('/styles/{id}', [
	'as'	=> 'styles.artistInfo',
	'uses'	=> 'StyleController@styleDiscs'
]);

Route::get('/styles/{id}/discs', [
	'as'	=> 'discs.discs_by_style',
	'uses'	=> 'DiscController@discs_by_style'
]);