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

Route::get('discs/details/user/vieweddisc/{id}', [
	'as'	=> 'user.new_visited_disc',
	'uses'	=> 'UserController@new_visited_disc'
]);

Route::get('/discs', 'DiscController@index');

Route::get('/discs/formato/{id}', [
	'as'   => 'discs.discos_formato',
	'uses' =>'DiscController@discos_formato'
]);

Route::get('/discs/details/{id}', [
	'as'	=> 'discs.details',
	'uses'	=>'DiscController@discs_details'
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

// Twitter OAuth login

//Route::get('/twitter', function () {
//    return view('twitter/twitterAuth');
//});
Route::get('auth/twitter', 'Auth\AuthController@redirectToTwitter');
Route::get('auth/twitter/callback', 'Auth\AuthController@handleTwitterCallback');

// Spotify OAuth Login

Route::get('auth/spotify', 'Auth\AuthController@redirectToSpotify');
Route::get('auth/spotify/callback', 'Auth\AuthController@handleSpotifyCallback');

// Términos de uso y política de privacidad
Route::get('/terminosdeservicio', function()
{
    return view('/legal/servicio');
});
Route::get('/politicaprivacidad', function()
{
    return view('/legal/privacidad');
});

// BACKEND
Route::get('/admin', [
	'as'	=> 'user.admin',
	'uses'	=> 'UserController@admin',
	'middleware' => ['auth', 'roles'],
	'roles' => ['Admin', 'Employee']
]);

// Scrapping LASTFM
Route::get('/admin/albumsbytag', [
	'as'	=> 'admin.albumsbytag',
	'uses'	=> 'LastfmscrappingController@albumsbytag',
	'middleware' => ['auth', 'roles'],
	'roles' => ['Admin', 'Employee']
]);
Route::get('/admin/addalbum/{albumname}/{artistname}', [
	'as'	=> 'admin.addalbum',
	'uses'	=> 'LastfmscrappingController@addalbum',
	'middleware' => ['auth', 'roles'],
	'roles' => ['Admin', 'Employee']
]);
Route::get('/admin/addalbumtodb', [
	'as'	=> 'admin.addalbumtodb',
	'uses'	=> 'LastfmscrappingController@addalbumtodb',
	'middleware' => ['auth', 'roles'],
	'roles' => ['Admin', 'Employee']
]);
Route::get('/admin/useraddalbumtodb', [
	'as'	=> 'admin.useraddalbumtodb',
	'uses'	=> 'LastfmscrappingController@useraddalbumtodb',
	'middleware' => ['auth', 'roles'],
	'roles' => ['Admin', 'Employee']
]);
Route::get('/admin/gestionPedidos', [
	'as'	=> 'admin.gestionPedidos',
	'uses'	=> 'LastfmscrappingController@gestionPedidos',
	'middleware' => ['auth', 'roles'],
	'roles' => ['Admin', 'Employee']
]);
Route::get('/admin/searchalbum', [
	'as'	=> 'admin.searchalbum',
	'uses'	=> 'LastfmscrappingController@searchalbum',
	'middleware' => ['auth', 'roles'],
	'roles' => ['Admin', 'Employee']
]);
Route::get('/admin/rellenarbbdd', [
	'as'	=> 'admin.rellenarbbdd',
	'uses'	=> 'LastfmscrappingController@rellenarbbdd',
	'middleware' => ['auth', 'roles'],
	'roles' => ['Admin', 'Employee']
]);
Route::get('/condiciones', 'HomeController@condiciones');
Route::get('/avisolegal', 'HomeController@avisolegal');
Route::get('/gastosenvio', 'HomeController@gastosenvio');
Route::get('/contacto', 'HomeController@contacto');
