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

Route::get('/pages/about', [
	'as' => 'about',
	'uses' => 'LinksController@about'
]);

//une fois connect�, acc�de � toutes les listes de taches/sous t�ches de l'utilisateur
Route::get('/pages/home',[
	'as'=>'home',
	'uses'=>'LinksController@home'
]);

//acces � la creation de taches
Route::get('/errors/nouvelle_liste_errors',[
	'as'=>'creation_liste_errors',
	'uses'=>'LinksController@creation_liste_errors'
]);

//acces � la creation de taches
Route::get('/pages/creation_liste',[
	'as'=>'creation_liste',
	'uses'=>'LinksController@creation_liste'
]);

//formulaire de creation de taches
Route::post('/pages/creation_liste',[
	'as'=>'creation_liste',
	'uses'=>'LinksController@creation_liste_soumission'
]);

Route::get('/pages/creation_tâche/{id}',[
	'as'=>'creation_tâche',
	'uses'=>'LinksController@creation_tâche'
]);

Route::post('/pages/creation_tâche',[
	'as'=>'creation_tâche_soumission',
	'uses'=>'LinksController@creation_tâche_soumission'
]);

//acces � l'espace personnel de l'utilisateur
Route::get('/pages/compte',[
	'as'=>'espace_personnel',
	'uses'=>'LinksController@espace_personnel'
]);

//mise à jour liste et description
Route::match(['get','post'],'/pages/update_liste/{id}',[
	'as'=>'updateliste',
	'uses'=>'LinksController@updateliste'
]);

//mise à jour tache d'une liste
Route::match(['get','post'],'/pages/update/tache/{id}',[
	'as'=>'updatetache',
	'uses'=>'LinksController@updatetache'
]);

Route::get('/delete/liste/{id}',[
	'as'=>'deleteliste',
	'uses'=>'LinksController@deleteliste'
]);

Route::get('/delete/tache/{id}',[
	'as'=>'deletetache',
	'uses'=>'LinksController@deletetache'
]);

Route::get('/validation/{id}',[
	'as'=>'validationtache',
	'uses'=>'LinksController@validationtache'
]);




//inscription
Route::get('auth/register', [
	'as' => 'inscription',
	'uses' => 'Auth\AuthController@getRegister'
]);
Route::post('auth/register', [
	'as' => 'inscription',
	'uses' => 'Auth\AuthController@postRegister'
]);

//login
Route::get('auth/login', [
	'as'=>'login',
	'uses'=>'Auth\AuthController@getLogin'
]);

Route::post('auth/login', [
	'as'=>'login',
	'uses'=>'Auth\AuthController@postLogin'
]);

//Route de d�connexion
Route::get('auth/logout', [
	'as'=>'logout',
	'uses'=>'Auth\AuthController@getLogout'
]);



