<?php

namespace App\Http\Controllers;
use App\Product;

use App\product_categories;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $all_product_category = product_categories::all();
        return view('admin/product_category/index',compact('all_product_category'));
    }
    public function create()
    {
        return view('admin/product_category/create');
    }

    public function store(Request $request)
    {
        $category_data = $request->all();   //將送來的request存成變數
        product_categories::create($category_data);  //將資料用create方式儲存進資料庫，並建立成一變數
        return redirect('/home/productCategory');
    }


    public function edit($id)
    {
        $product_category = product_categories::find($id);

        return view('admin/product_category/edit',compact('product_category'));
    }

    public function update(Request $request,$id)
    {
        $request_data = $request->all();  //將送來的request存成變數
        $item = product_categories::find($id);  //以id抓到正在動作的是哪一筆資料
        $item_category_name = $item->name;  //更新前名稱
        $new_category_name = $request_data['name'];  //更新後的名稱
        // 更新產品類別名稱時也要將有套用到此產品類別的產品做更新
        $products = Product::where('category',$item_category_name)->get();  //此類別的產品(array)
        foreach ($products as $product) {
            $product->category = $new_category_name;
            $product->update();
        }

        $item->update($request_data);  //進行資料更新
        return redirect('/home/productCategory');
    }

    public function delete($id)
    {
        $item = product_categories::find($id);  //找到正在執行動作的是哪一筆資料

        $item_category_name = $item->name;  //要被刪除的類別名稱
        // 刪除類別時也要將有套用到此類別的產品修改為預設類別
        $products = Product::where('category',$item_category_name)->get();
        foreach ($products as $product) {
            $product->category = 'default';
            $product->update();
        }



        $item->delete(); //刪除資料

        return redirect("/home/productCategory");
    }














    public function sort_down(Request $request)
    {
        // 依照ajax送進來的資料，抓到正在動作的是哪一筆資料(主資料)
        $item = product_categories::find($request->data_id);
        // 抓到主資料的目前sort值
        $sort_value = $item->sort;
        // 用where方法，抓到product_categories資料庫的sort欄位中值比主資料sort值還小的資料
        // 但抓出的資料有可能是複數比資料，所以將抓出來的資料依sort欄位的值大小進行排序(依up、down來更改排序方式)
        // 排序後以first抓到第一筆，存成變數(目標資料)
        $target = product_categories::where('sort','<',$sort_value)->orderby('sort','desc')->first();

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
        $item = product_categories::find($request->data_id);
        // 抓到主資料的目前sort值
        $sort_value = $item->sort;
        // 用where方法，抓到product_categories資料庫的sort欄位中值比主資料sort值還大的資料
        // 但抓出的資料有可能是複數比資料，所以將抓出來的資料依sort欄位的值大小進行排序(依up、down來更改排序方式)
        // 排序後以first抓到第一筆，存成變數(目標資料)
        $target = product_categories::where('sort','>',$sort_value)->orderby('sort','asc')->first();
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
