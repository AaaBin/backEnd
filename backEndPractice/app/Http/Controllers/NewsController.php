<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $all_news = News::all();  //從News引用，引用所有資料
        return view('admin/news/index', compact("all_news"));  //將這筆資料夾帶進這頁面
    }
    public function create()
    {
        return view('admin/news/create');
    }
    public function store(Request $request)
    {
        $news_data = $request->all();
        News::create($news_data)->save();
        return redirect('/home/news');
    }



    public function edit($id)
    {
        $news = News::find($id);
        return view('admin/news/edit',compact('news'));
    }

    public function update(Request $request,$id)
    {
        // $test = $request->all();
        // @dd("update",$id,$test);
        // 因csrf的關係，有toke，更新時有可能需將token排除
        // $update_news = $request->except("_token");
        News::find($id)->update($request->all());
        return redirect('/home/news');
    }

    public function delete($id)
    {
        @dd("delete",$id);
    }


}
