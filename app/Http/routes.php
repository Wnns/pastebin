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
Route::get('/p/{pasteStringID}', 'PasteController@viewPaste');
Route::get('/p/{pasteStringID}/remove', 'PasteController@removePaste')->middleware('auth');
Route::get('/p/{pasteStringID}/raw', 'PasteController@viewRawPaste');
Route::get('/popular', 'PasteController@viewPopularPastes');
Route::get('/dashboard', 'UserController@viewDashboard')->middleware('auth');

Route::get('/login', function () { return view('login'); })->middleware('guest');
Route::get('/register', function () { return view('register'); })->middleware('guest');
Route::get('/logout', 'UserController@logout');

Route::post('addPaste', 'PasteController@addPaste');
Route::post('login', 'UserController@aunthenticate');
Route::post('register', 'UserController@create');

View::composer('*', function($view){

	$view -> with('lastPastes', \App\PasteModel::getLastPastes());
});