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

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');
Route::get('/nis', 'PagesController@nis');
Route::get('/mapa', 'PagesController@mapa');
Route::get('/show/{id}', 'PagesController@show');

Route::get('/stans/create_adr', 'StansController@create_adr');
Route::get('/stans/create_nas', 'StansController@create_nas');


Route::resource('posts', 'PostsController');
Route::resource('stans', 'StansController');


Route::get('/photos/create/{id}', ['as' => 'photoinsert', 'uses' =>'PhotosController@create']);

Route::post('/photos/store', 'PhotosController@store');

Route::get('/stans/{id}/mapa', ['as' => 'mapaid', 'uses' =>'StansController@mapa']);


Route::put('/stans/{id}/latlng', ['as' => 'latln', 'uses' =>'StansController@latlng']);









Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
