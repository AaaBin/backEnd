<?php

namespace App\Http\Controllers;

use App\Product;
use App\product_categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index()
    {
        $all_product = product::with('categories')->get();
        return view('admin/product/index',compact('all_product'));
    }
    public function create()
    {
        $cotegories = product_categories::all()->sortByDesc("sort");
        return view('admin/product/create',compact('cotegories'));
    }

    public function store(Request $request)
    {
        $product_data = $request->all();

        $file = $request->file("url")->store('product','public');
        $product_data['url'] = $file;

        Product::create($product_data)->save();
        return redirect('/home/product');
    }


    public function edit($id)
    {
        $product = Product::find($id);
        $cotegories = product_categories::all()->sortByDesc("sort");
        return view('admin/product/edit',compact('product','cotegories'));
    }
    public function update(Request $request,$id)
    {
        $request_data = $request->all();  //將送來的request存成變數
        $item = Product::find($id);  //以id抓到正在動作的是哪一筆資料

        // 刪除舊有圖片:
        if($request->hasFile('url')){ //判斷是否有新增檔案上傳
            $old_img = $item->url;     //若有，抓到原資料中的url欄位內容
            // !!!注意!!!  用storage時需安裝套件:league/flysystem-cached-adapter
            Storage::disk('public')->delete($old_img);  //用Storage刪除
            // !!!注意!!!
            $new_img = $request->file('url')->store('product','public');  //抓到新上傳的檔案並儲存進public
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





    public function sort_down(Request $request)
    {
        // 依照ajax送進來的資料，抓到正在動作的是哪一筆資料(主資料)
        $item = Product::find($request->data_id);
        // 抓到主資料的目前sort值
        $sort_value = $item->sort;
        // 用where方法，抓到Product資料庫的sort欄位中值比主資料sort值還小的資料
        // 但抓出的資料有可能是複數比資料，所以將抓出來的資料依sort欄位的值大小進行排序(依up、down來更改排序方式)
        // 排序後以first抓到第一筆，存成變數(目標資料)
        $target = Product::where('sort','<',$sort_value)->orderby('sort','desc')->first();

        if ($target == null) {
            // 進行判斷，如果目標資料不存在，代表主資料的sort值已經是最小
            // 第二個判斷，如果sort值大於0，則讓sort值減1，並變更進資料庫
            if($sort_value > 0){
            $item->sort = $sort_value - 1;
            }
            // 建立一個新變數，值是主資料的sort值減1，作為傳回頁面的資料
            $sort_value_new = $sort_value - 1;
            // 建立要回傳的資料，也就是原先值-1之後的數值
            $result = [$sort_value_new];

        }else{
            // 目標資料如果存在，就可以將主資料的sort值與目標資料的sort值互換
            // 將目標資料的值建立成變數
            $target_sort_value = $target->sort;
            // 主資料的值改成目標資料的值
            $item->sort = $target_sort_value;
            // 目標資料的值改成主資料的值
            $target->sort = $sort_value;
            // 將目標資料的變更更新進資料庫
            $target->update();
            // 建立新變數表示新的索引值，
            $sort_value_new = $sort_value;
            $target_id = $target->id;
            $result = [$target_sort_value,$sort_value_new,$target_id];

        }
        $item->update();
        return $result;
    }


    public function sort_up(Request $request)
    {
        // 依照ajax送進來的資料，抓到正在動作的是哪一筆資料(主資料)
        $item = Product::find($request->data_id);
        // 抓到主資料的目前sort值
        $sort_value = $item->sort;
        // 用where方法，抓到Product資料庫的sort欄位中值比主資料sort值還大的資料
        // 但抓出的資料有可能是複數比資料，所以將抓出來的資料依sort欄位的值大小進行排序(依up、down來更改排序方式)
        // 排序後以first抓到第一筆，存成變數(目標資料)
        $target = Product::where('sort','>',$sort_value)->orderby('sort','asc')->first();
        // 先建立對象資料更改後的sort值，也就是主資料的sort值

        if ($target == null) {
            // 進行判斷，如果目標資料不存在，代表主資料的sort值已經是最大
            $item->sort = $sort_value + 1;

            // 建立一個新變數，值是主資料的sort值減1，作為傳回頁面的資料
            $sort_value_new = $sort_value + 1;
            // 建立要回傳的資料，也就是原先值+1之後的數值
            $result = [$sort_value_new];

        }else{
            // 目標資料如果存在，就可以將主資料的sort值與目標資料的sort值
            $target_sort_value = $target->sort;
            $item->sort = $target_sort_value;
            $target->sort = $sort_value;
            $target->update();
            $sort_value_new = $sort_value;
            $target_id = $target->id;
            $result = [$target_sort_value,$sort_value_new,$target_id];

        }
        $item->update();
        return $result;
    }
}
