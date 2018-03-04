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

Auth::routes();

Route::group(['namespace' => 'Site', 'middleware' => ['auth','admin']],function(){
	
	Route::get('pages', 'PageController@index');
	Route::get('pages/create', 'PageController@create');
	Route::get('pages/edit/{id}', 'PageController@edit');
	Route::post('pages/store/{id?}', 'PageController@store');
	Route::post('pages/delete/{id}', 'PageController@delete');

	Route::get('users', 'UserController@index');
	Route::post('users/store', 'UserController@store');
	Route::post('users/delete/{id}', 'UserController@delete');

	Route::get('{slug}', 'PageController@renderDynamicPage');
});
