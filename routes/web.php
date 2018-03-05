<?php

use App\Events\TestEvent;
use Illuminate\Support\Facades\App;

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

<<<<<<< HEAD

Route::get('/broadcast', function() {
    event(new TestEvent('Broadcasting in Laravel using Pusher!'));

    return view('welcome');
});


Route::get('/bridge', function() {
    $pusher = App::make('pusher');

    $pusher->trigger( 'test-channel',
                      'test-event', 
                      array('text' => 'Preparing the Pusher Laracon.eu workshop!'));

    return view('welcome');
});

Route::get('notification', 'NotificationController@index');
Route::post('notification', 'NotificationController@notify');
=======
Auth::routes();

Route::group(['namespace' => 'Admin', 'middleware' => ['auth','admin']],function(){
	
	Route::get('pages', 'PageController@index');
	Route::get('pages/create', 'PageController@create');
	Route::get('pages/edit/{id}', 'PageController@edit');
	Route::post('pages/store/{id?}', 'PageController@store');
	Route::post('pages/delete/{id}', 'PageController@delete');

	Route::get('users', 'UserController@index');
	Route::post('users/store', 'UserController@store');
	Route::post('users/delete/{id}', 'UserController@delete');

});

/**
 * Site Namespace
 */
Route::group(['namespace' => 'Site'],function(){

	Route::get('{slug}', 'PageController@renderDynamicPage');

	Route::group(['middleware' => ['auth']],function(){

		Route::post('store-comment/{page_id}', 'PageController@storeComment');
		Route::post('delete-comment/{id}', 'PageController@deleteComment');
	});

});
>>>>>>> 07ee1c3af8b81a53e517a94c7c3a98b64cb45c22
