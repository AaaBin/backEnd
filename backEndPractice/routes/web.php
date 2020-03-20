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

// permission test
// Route::get('/createRoleAndPermission', 'FrontController@createRoleAndPermission');
// Route::get('/permission/assignRole', 'FrontController@assignRole');

// test route
Route::get('/test','FrontController@test');

// 一般訪客登入頁面
Route::get('/login_guest','FrontController@login_guest');


// 將路徑改寫成經過controller
// FrontController@news  -->> 使用FrontController中的news函式
Route::get('/', 'FrontController@index');  //前端，首頁
Route::get('/news', 'FrontController@news');  //前端，最新消息頁，list apge
Route::get('/news/detail/{id}', 'FrontController@news_detail');  //前端，最新消息頁，content apge
Route::get('/product', 'FrontController@product');  //前端，產品頁面
Route::get('/contacts', 'FrontController@contact');  //前端，聯絡頁面
Route::get('/shoppingcart','FrontController@shoppingcart');   //購物車page
Route::get('/account','FrontController@account');  //account page
Route::get('/product_detail/{productID}','FrontController@product_detail');  //product detail

Route::post('/contact', 'ContactController@store'); //前端，聯絡頁面表單送出時的儲存route

// Cart
Route::post('/add_cart','CartController@add_cart');   //加入購物車功能
Route::post('/update_cart/{productID}','CartController@update');   //修改數量
Route::post('/delete_item/{productID}','CartController@deleteItem');   //刪除物品
Route::post('/checkout','CartController@checkout');   //成立訂單

Route::prefix('cart_ecpay')->group(function()
{
    //當消費者付款完成後，綠界會將付款結果參數以幕後(Server POST)回傳到該網址。
    Route::post('notify', 'CartController@notifyUrl')->name('notify');
    //付款完成後，綠界會將付款結果參數以幕前(Client POST)回傳到該網址
    Route::post('return', 'CartController@returnUrl')->name('return');
});


Auth::routes();


// middleware:中介層  ->代表這路徑要經過認證才可使用
// prefix:前綴字
Route::group(['middleware' => ['auth','RoleMiddleWare'], 'prefix' =>'/home'], function () {

    Route::get('/', 'HomeController@index')->name('home');


    // 最新消息
    Route::get('/news', 'NewsController@index');  //最新消息列表頁

    Route::get('/news/create', 'NewsController@create');  //新增最新消息頁面
    Route::post('/news/store', 'NewsController@store');   //儲存表單資料

    Route::get('/news/edit/{id}', 'NewsController@edit');  //修改最新消息頁面
    Route::post('/news/update/{id}', 'NewsController@update');  //修改最新消息
    // 刪除動作要避免使用get，以免使用者能夠藉由輸入網址來刪除資料
    Route::post('/news/delete/{id}', 'NewsController@delete');  //刪除最新消息

    Route::post('/news/edit/sort_up', 'NewsController@sort_up');  //更改排序
    // Route::get('/news/edit/sort_down/{id}', 'NewsController@sort_down');  //更改排序
    Route::post('/news/edit/sort_down', 'NewsController@sort_down');  //更改排序


    Route::post('/news/delete_news_sub_img', 'NewsController@delete_sub_img');  //edit page刪除sub_img
    Route::post('/news/change_sub_img_sort', 'NewsController@change_sub_img_sort');  //edit page更改sub_im的sort

    // 產品
    Route::get('/product', 'ProductController@index');  //產品列表

    Route::get('/product/create', 'ProductController@create'); //新增產品
    Route::post('/product/store', 'ProductController@store');   //儲存表單資料

    Route::get('/product/edit/{id}', 'ProductController@edit');  //修改產品頁面
    Route::post('/product/update/{id}', 'ProductController@update');  //更新

    Route::post('/product/delete/{id}', 'ProductController@delete');  //刪除產品

    Route::post('/product/edit/sort_up', 'ProductController@sort_up');  //更改排序
    Route::post('/product/edit/sort_down', 'ProductController@sort_down');  //更改排序

    // 產品類別
    Route::get('/productCategory', 'ProductCategoryController@index');  //產品類別列表

    Route::get('/productCategory/create', 'ProductCategoryController@create'); //新增產品類別
    Route::post('/productCategory/store', 'ProductCategoryController@store');   //儲存表單資料

    Route::get('/productCategory/edit/{id}', 'ProductCategoryController@edit');  //修改page
    Route::post('/productCategory/update/{id}', 'ProductCategoryController@update');  //更新

    Route::post('/productCategory/delete/{id}', 'ProductCategoryController@delete');  //刪除產品

    Route::post('/productCategory/edit/sort_up', 'ProductCategoryController@sort_up');  //更改排序
    Route::post('/productCategory/edit/sort_down', 'ProductCategoryController@sort_down');  //更改排序




    Route::post('/news/ajax_upload_img', 'summernoteUploadImg@ajax_upload_img');  //summernote upload img
    Route::post('/news/ajax_delete_img', 'summernoteUploadImg@ajax_delete_img');  //summernote upload img


    // contact
    Route::get('/contact', 'ContactController@index'); //contact後台index page

    Route::post('/contact/delete/{id}', 'ContactController@destroy'); //刪除

    // 訂單列表
    Route::get('/order_list', 'OrderListController@index'); //後台index page


});




