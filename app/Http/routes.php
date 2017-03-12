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

Route::get('/', function () { return view('home'); });
Route::get('/p/{pasteStringID}', 'PastesController@viewPaste');
Route::get('/p/{pasteStringID}/remove', 'PastesController@removePaste')->middleware('auth');
Route::get('/p/{pasteStringID}/raw', 'PastesController@viewRawPaste');
Route::get('/popular', 'PastesController@viewPopularPastes');
Route::get('/dashboard', 'UsersController@viewDashboard')->middleware('auth');

Route::get('/login', function () { return view('login'); })->middleware('guest');
Route::get('/register', function () { return view('register'); })->middleware('guest');
Route::get('/logout', 'UsersController@logout');

Route::post('addPaste', 'PastesController@addPaste');
Route::post('login', 'UsersController@aunthenticate');
Route::post('register', 'UsersController@create');

View::composer('*', function($view){

	$view -> with('lastPastes', \App\Pastes::getLastPastes());
});