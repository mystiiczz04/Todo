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

Route::get('/',[
	'as'=>'index',
	'uses'=>'LinksController@index'
]);

/*Route::post('/inscription',[
	'as'=>'inscription',
	'uses'=>'LinksController@inscription'
]);*/

Route::get('/lol',[
	'as'=>'lol',
	'uses'=>'LinksController@test'
]);

Route::get('auth/register', [
	'as' => 'inscription',
	'uses' => 'Auth\AuthController@getRegister'
]);
Route::post('auth/register', [
	'as' => 'inscription',
	'uses' => 'Auth\AuthController@postRegister'
]);
Route::get('/home', [
	'as' => 'home',
	'uses' => 'LinksController@home'

]);

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');

//Route de déconnexion
Route::get('auth/logout', 'Auth\AuthController@getLogout');

//Route::get('home', 'HomeController@index');

/*Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);*/
