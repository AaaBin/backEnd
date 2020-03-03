<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('admin/news/index');
    }

    public function store(Request $request)
    {
        $news_data = $request->all();
        News::create($news_data)->save();
        return redirect('/home/news');
    }
}
