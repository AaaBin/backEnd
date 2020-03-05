<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index()
    {
        $all_product = Product::all();
        return view('admin/product/index',compact('all_product'));
    }
    public function create()
    {
        return view('admin/product/create');
    }

    public function store(Request $request)
    {
        $product_data = $request->all();

        $file = $request->file("url")->store('','public');
        $product_data['url'] = $file;

        Product::create($product_data)->save();
        return redirect('/home/product');
    }


    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin/product/edit',compact('product'));
    }
    public function update(Request $request,$id)
    {
        dd($request);

        $request_data = $request->all();  //將送來的request存成變數
        $item = Product::find($id);  //以id抓到正在動作的是哪一筆資料

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
        return redirect('/home/product');
    }

    public function delete($id)
    {
        $item = Product::find($id);  //找到正在執行動作的是哪一筆資料
        Storage::disk('public')->delete("$item->url");  //將資料的檔案刪除
        $item->delete(); //刪除資料
        return redirect("/home/product");
    }

    public function sort_up($id)
    {
        $item = Product::find($id);
        $sort_value = $item->sort;
        $target = Product::where('sort','>',$sort_value)->orderby('sort','asc')->first();
        if ($target == null) {
            $item->sort = $sort_value + 1;
        }else{
            $target_sort_value = $target->sort;
            $item->sort = $target_sort_value;
            $target->sort = $sort_value;
            $target->update();
        }
        $item->update();
        return redirect('home/product');
    }
    public function sort_down($id)
    {
        $item = Product::find($id);
        $sort_value = $item->sort;
        $target = Product::where('sort','<',$sort_value)->orderby('sort','desc')->first();
        if ($target == null) {
            $item->sort = $sort_value - 1;
        }else{
            $target_sort_value = $target->sort;
            $item->sort = $target_sort_value;
            $target->sort = $sort_value;
            $target->update();
        }
        $item->update();
        return redirect('home/product');
    }

}
