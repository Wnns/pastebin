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
   
    return view('home');
});

View::composer('*', function($view){

	$view -> with('lastPastes', \App\PasteModel::getLastPastes());
});

Route::get('p/{pasteStringID}', 'PasteController@viewPaste');
Route::get('addPaste', function(){ 
	
	return view('addPaste') ;
});

Route::post('addPaste', 'PasteController@addPaste');

