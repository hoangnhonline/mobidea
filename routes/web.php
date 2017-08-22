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
Route::post('/login',['as' => 'do-login' , 'uses' => 'HomeController@doLogin']);
Route::get('/login',['as' => 'login-form' , 'uses' => 'HomeController@loginForm']);
Route::get('/logout',['as' => 'logout', 'uses' => 'HomeController@doLogout']);
Route::get('/',  [
            'as' => 'home',
            'uses' => 'HomeController@index']);
 
Route::group(['middleware' => 'isAdmin'], function () {	    
	
	Route::group(['prefix' => 'tools'], function () {    
    	Route::get('/', ['as' => 'tools-index', 'uses' => 'ToolsController@index']);
        Route::get('meta/', ['as' => 'tools-meta', 'uses' => 'ToolsController@meta']);        
	});

	Route::group(['prefix' => 'settings'], function () {
        Route::get('/', ['as' => 'settings.index', 'uses' => 'SettingsController@index']);
        Route::post('/update', ['as' => 'settings.update', 'uses' => 'SettingsController@update']);
    });    

    Route::group(['prefix' => 'account'], function () {
        Route::get('/', ['as' => 'account.index', 'uses' => 'AccountController@index']);
        Route::get('/change-password', ['as' => 'account.change-pass', 'uses' => 'AccountController@changePass']);
        Route::post('/store-password', ['as' => 'account.store-pass', 'uses' => 'AccountController@storeNewPass']);
        Route::get('/update-status/{status}/{id}', ['as' => 'account.update-status', 'uses' => 'AccountController@updateStatus']);
        Route::get('/create', ['as' => 'account.create', 'uses' => 'AccountController@create']);
        Route::post('/store', ['as' => 'account.store', 'uses' => 'AccountController@store']);
        Route::get('{id}/edit',   ['as' => 'account.edit', 'uses' => 'AccountController@edit']);
        Route::post('/update', ['as' => 'account.update', 'uses' => 'AccountController@update']);
        Route::get('{id}/destroy', ['as' => 'account.destroy', 'uses' => 'AccountController@destroy']);
    });
    Route::group(['prefix' => 'smart-link'], function () {
        Route::get('/', ['as' => 'smart-link.index', 'uses' => 'SmartLinkController@index']);
        Route::get('/create', ['as' => 'smart-link.create', 'uses' => 'SmartLinkController@create']);
        Route::post('/store', ['as' => 'smart-link.store', 'uses' => 'SmartLinkController@store']);
        Route::get('{id}/edit',   ['as' => 'smart-link.edit', 'uses' => 'SmartLinkController@edit']);
        Route::post('/update', ['as' => 'smart-link.update', 'uses' => 'SmartLinkController@update']);
        Route::get('{id}/destroy', ['as' => 'smart-link.destroy', 'uses' => 'SmartLinkController@destroy']);
    });
});


	

