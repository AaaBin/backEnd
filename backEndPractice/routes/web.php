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

    Route::get('/news', 'NewsController@index');  //後台，最新消息表單
    Route::post('/news/store', 'NewsController@store');   //儲存表單資料

    Route::get('/product', 'ProductController@index');  //後台，產品表單
    Route::post('/product/store', 'productController@store');   //儲存表單資料


});






Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
