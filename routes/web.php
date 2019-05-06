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
Auth::routes();

Route::get('/','PagesController@home');
Route::get('/play','PagesController@play');
Route::get('/statistics', 'PagesController@statistics');
Route::get('/guide','PagesController@guide');
Route::get('/shop','PagesController@shop');
Route::get('/constructor','PagesController@constructor');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/ecgitems/create', 'ECGItemsController@create');
Route::post('/ecgitems', 'ECGItemsController@store');
Route::get('/ecgitems/{id}','ECGItemsController@edit');
Route::post('/ecgitems/{id}','ECGItemsController@update');
Route::delete('/ecgitems/{id}','ECGItemsController@destroy');

Route::get('/buildings/create', 'BuildingsController@create');
Route::post('/buildings', 'BuildingsController@store');
Route::get('/buildings/{id}','BuildingsController@edit');
Route::post('/buildings/{id}','BuildingsController@update');
Route::delete('/buildings/{id}','BuildingsController@destroy');

Route::get('/minmaxes/create', 'MinMaxesController@create');
Route::post('/minmaxes', 'MinMaxesController@store');
Route::get('/minmaxes/{minmax}','MinMaxesController@edit');
Route::post('/minmaxes/{minmax}','MinMaxesController@update');
Route::delete('/minmaxes/{minmax}','MinMaxesController@destroy');

Route::get('/profile','DashboardController@show');
Route::post('/profile','DashboardController@update');
Route::delete('/profile','DashboardController@destroy');

Route::post('/records','RecordController@calculate');

