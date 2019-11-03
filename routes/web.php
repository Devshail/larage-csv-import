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
Route::get('/','HomeController@dataTable')->name('dashboard');
Route::get('/get-data','HomeController@getData')->name('getdata');
Route::get('/csv_import','ImportController@csvImport')->name('csv_import');
Route::post('/csv_save','ImportController@saveAndUploadCSV')->name('csv_save');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
