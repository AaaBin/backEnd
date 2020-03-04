<?php

namespace App\Http\Controllers;

// 略過model直接使用database
use DB;

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

    public function product()
    {
        $product_data = DB::table('product')->orderBy("sort",'desc')->get();
        return view('front/product', compact('product_data'));
    }

}
