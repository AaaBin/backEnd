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
Route::get('/', 'FrontController@index');  //前端，首頁

Route::get('/news', 'FrontController@news');  //前端，最新消息頁

Route::get('/product', 'FrontController@product');  //前端，產品頁面


Auth::routes();


Route::get('/send-mail', 'HomeController@sendMail'); //發郵件測試用

// middleware:中介層  ->代表這路徑要經過認證才可使用
// prefix:前綴字
Route::group(['middleware' => ['auth'], 'prefix' =>'/home'], function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/news', 'NewsController@index');  //最新消息列表頁

    Route::get('/news/create', 'NewsController@create');  //新增最新消息頁面
    Route::post('/news/store', 'NewsController@store');   //儲存表單資料

    Route::get('/news/edit/{id}', 'NewsController@edit');  //修改最新消息頁面
    Route::post('/news/update/{id}', 'NewsController@update');  //修改最新消息

    Route::post('/news/delete/{id}', 'NewsController@delete');  //刪除最新消息





    Route::get('/product', 'ProductController@index');  //產品列表

    Route::get('/product/create', 'ProductController@create'); //新增產品
    Route::post('/product/store', 'productController@store');   //儲存表單資料

    Route::get('/product/edit/{id}', 'ProductController@edit');  //修改產品頁面
    Route::post('/product/update/{id}', 'ProductController@update');  //修改產品
    
    Route::post('/product/delete/{id}', 'ProductController@delete');  //刪除產品



});






Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
