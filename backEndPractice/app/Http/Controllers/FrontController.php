<?php

namespace App\Http\Controllers;

// 略過model直接使用database
use DB;
use App\News;
use App\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

    public function contact()
    {
        return view('front/contact');
    }



    public function product_detail($productID)
    {
        $item = Product::find($productID);
        return view('front/product_detail',compact('item'));
    }


    public function add_cart(Request $request)
    {
        $request_data = $request->all();
        $Product = Product::find($request_data['productID']); // assuming you have a Product model with id, name, description & price
        $rowId = 456; // generate a unique() row ID
        $userID = Auth::user()->id; // the user ID to bind the cart contents
        \Cart::add(array(
            'id' => 456, // inique row ID
            'name' => 'Sample Item',
            'price' => 67.99,
            'quantity' => 4,
            'attributes' => array()
        ));
        \Cart::session($userID)->add(array(
            'id' => $rowId,
            'name' => $Product->name,
            'price' => $Product->price,
            'quantity' => $request_data['qty'],
            'capcity' => $request_data['capcity'],
            'color' =>$request_data['color'],
            'attributes' => array(),
            'associatedModel' => $Product
        ));

        return redirect('/shoppingcart');
    }

    public function shoppingcart()
    {
        $id = Auth::user()->id;
        $items = \Cart::session($id)->getContent();
        return view('front/shopping_cart',compact('items'));
    }

}
