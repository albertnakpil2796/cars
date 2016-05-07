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

Route::get('/', 'CarController@index');
Route::get('/car/car_list','CarController@car_list');
Route::get('/car/add','CarController@add');
Route::get('/car/update/{id}/{inId}/{first}','CarController@move');

Route::post('car/filter','CarController@filter');
Route::post('car/save','CarController@store');
Route::post('car/view','CarController@view');
Route::post('car/edit','CarController@edit');
Route::post('car/delete','CarController@destroy');