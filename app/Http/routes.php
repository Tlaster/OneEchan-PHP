<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/api/list/{prefLang}', 'ApiController@mainList');
Route::get('/api/detail/{prefLang}/{id}','ApiController@detailItem');
Route::get('/api/play/{prefLang}/{id}/{filename}','ApiController@playItem');
Route::get('/api/search/{prefLang}/{title}','ApiController@searchItem');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', 'ViewController@index');
    Route::get('/search', 'ViewController@search');
    Route::get('/{id}', 'ViewController@detail');
    Route::get('/{id}/{filename}','ViewController@play');
    Route::post('/{id}/{filename}','ViewController@postComment');
});
