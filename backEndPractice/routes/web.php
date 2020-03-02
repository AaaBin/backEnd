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

// 將路徑改寫成經過controller
// FrontController@news  -->> 使用FrontController中的news函式
Route::get('/', 'FrontController@index');

Route::get('/news', 'FrontController@news');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
