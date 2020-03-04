<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $file = $request->file("url")->store('','public');
        // dd($file);
        $news_data['url'] = $file;


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


        $item = News::find($id);
        // 刪除舊有圖片
        if($request->hasFile('url')){
            $old_img = $item->url;
            Storage::delete($old_img);
        }

        // $item->update($request->all());
        // return redirect('/home/news');
    }

    public function delete($id)
    {
        News::find($id)->delete();
        return redirect("/home/news");
    }

    public function sort_up($id)
    {
        $A = News::find($id);
        @dd($A);
    }


}
