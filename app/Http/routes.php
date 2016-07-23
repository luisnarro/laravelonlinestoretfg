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

Route::get('/home', [
	'middleware' => 'auth',
	'as'	=> 'user.index',
	'uses'	=> 'UserController@index'
]);
Route::get('/user/addtocart/{id}', [
	'middleware' => 'auth',
	'as'   => 'user.add_to_cart',
	'uses' =>'UserController@add_to_cart'
]);
Route::get('/user/shoppingcart', [
	'middleware' => 'auth',
	'as'   => 'user.shoppingcart',
	'uses' =>'UserController@shoppingcart'
]);
Route::get('/user/checkoutsp', [
	'middleware' => 'auth',
	'as'   => 'user.checkoutsp',
	'uses' =>'UserController@checkoutsp'
]);
Route::get('/user/update_usercart/{rowId}', [
	'middleware' => 'auth',
	'as'   => 'user.update_usercart',
	'uses' =>'UserController@update_usercart'
]);
Route::get('/user/remove_usercart_item/{rowId}', [
	'middleware' => 'auth',
	'as'   => 'user.remove_usercart_item',
	'uses' =>'UserController@remove_usercart_item'
]);

Route::get('/discs', 'DiscController@index');
Route::get('/discs/formato/{id}', [
	'as'   => 'discs.discos_formato',
	'uses' =>'DiscController@discos_formato'
]);
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

// Twitter OAuth2 login

Route::get('/twitter', function () {
    return view('twitter/twitterAuth');
});
Route::get('auth/twitter', 'Auth\AuthController@redirectToTwitter');
Route::get('auth/twitter/callback', 'Auth\AuthController@handleTwitterCallback');