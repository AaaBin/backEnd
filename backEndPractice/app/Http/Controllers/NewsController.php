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
        // 因csrf的關係，有toke，更新時有「可能」需將token排除
        // $update_news = $request->except("_token");

        $request_data = $request->all();  //將送來的request存成變數

        $item = News::find($id);  //以id抓到正在動作的是哪一筆資料

        // 刪除舊有圖片:
        if($request->hasFile('url')){ //判斷是否有新增檔案上傳
            $old_img = $item->url;     //若有，抓到原資料中的url欄位內容
            // !!!注意!!!  用storage時需安裝套件:league/flysystem-cached-adapter
            Storage::disk('public')->delete($old_img);  //用Storage刪除
            // !!!注意!!!
            $new_img = $request->file('url')->store('','public');  //抓到新上傳的檔案並儲存進public
            $request_data["url"] = $new_img;  //將送進來的request中的url改成儲存的檔名
        }

        $item->update($request_data);  //進行更新
        return redirect('/home/news');
    }

    public function delete($id)
    {
        $item = News::find($id);  //找到正在執行動作的是哪一筆資料
        Storage::disk('public')->delete("$item->url");  //將資料的檔案刪除
        $item->delete(); //刪除資料
        return redirect("/home/news");
    }

    public function sort_up($id)
    {
        $A = News::find($id);
        @dd($A);
    }


}
