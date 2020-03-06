<?php

namespace App\Http\Controllers;

// 略過model直接使用database
use DB;
use App\News;


class FrontController extends Controller
{

    public function index()
    {
        return view('front/index');
    }
    public function news()
    {
        // 從DB中拿資料須建立成變數
        // 並使用get()
        $news_data = DB::table('news')->orderBy("sort",'desc')->get();
        // orderBy:根據資料欄位排序

        // 然後用compact()將資料傳入頁面中
        return view('front/news', compact('news_data'));
    }
    public function news_detail($id)
    {
        // 方法一:在controller中用find指向關聯的function，缺點，要將關聯的資料跟子資料分成兩筆變數夾帶進頁面
        // $news_img = News::find($id)->news_imgs;
        // 方法二:在view頁面中也可以使用關聯的function
        $item = News::find($id);


        // 方法三:with('functionname')  會將關連的子資料夾帶進主資料中，多形成一個欄位
        $item2 = News::with('news_imgs')->find($id)->orderBy("sort",'desc');
        return view('front/news_detail' , compact('item','item2'));
    }






    public function product()
    {
        $product_data = DB::table('product')->orderBy("sort",'desc')->get();
        return view('front/product', compact('product_data'));
    }

}
