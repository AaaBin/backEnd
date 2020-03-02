<?php

namespace App\Http\Controllers;

// 略過model直接使用database
use DB;
use Illuminate\Http\Request;

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
        $news_data = DB::table('news')->get();

        // 然後用compact()將資料傳入頁面中
        return view('front/news' , compact('news_data'));
    }

    public function product()
    {
        $product_data = DB::table('product')->get();
        return view('front/product' , compact('product_data'));
    }


}
