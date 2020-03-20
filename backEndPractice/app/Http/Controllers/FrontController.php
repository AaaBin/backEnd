<?php

namespace App\Http\Controllers;

// 略過model直接使用database
use DB;
use App\News;
use App\Order;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;


class FrontController extends Controller
{




    // permission test
    // public function createRoleAndPermission()
    // {
    //     $admin_role = Role::create(['name' => 'admin']); //建立role:admin
    //     $admin_permission = Permission::create(['name' => 'do every thing']);  //建立permission
    //     $admin_role->givePermissionTo($admin_permission); //將role與permission關聯

    //     $normal_role = Role::create(['name' => 'normal_user']); //建立role:normal
    //     $normal_permission = Permission::create(['name' => 'a normal user']);
    //     $normal_role->givePermissionTo($normal_permission);
    // }
    // public function assignRole()
    // {
    //     $user = Auth::user(); //將現在使用者套用上admin這一role
    //     $user->assignRole('admin');
    // }

    // 測試用
    public function test()
    {
        return view('front/test');
    }


    public function index()
    {
        return view('front/index');
    }
    public function news()
    {
        // 從DB中拿資料須建立成變數
        // 並使用get()
        $news_data = DB::table('news')->orderBy("sort", 'desc')->get();
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
        $item2 = News::with('news_imgs')->find($id)->orderBy("sort", 'desc');
        return view('front/news_detail', compact('item', 'item2'));
    }

    public function product()
    {
        $product_data = DB::table('product')->orderBy("sort", 'desc')->get();
        return view('front/product', compact('product_data'));
    }

    public function contact()
    {
        return view('front/contact');
    }

    public function product_detail($productID)
    {
        $item = Product::find($productID);
        return view('front/product_detail', compact('item'));
    }


    public function shoppingcart()
    {
        if (Auth::user()) {
            $id = Auth::user()->id;
            $items = \Cart::session($id)->getContent()->sort();

            return view('front/shopping_cart', compact('items','id'));
        } else {
            return redirect('/login_guest')->with('status','not login yet');
        }

    }

    public function account()
    {
        $user = Auth::user();
        $order_datas = Order::where('user_id',$user->id)->get();
        return view('front/account',compact('user','order_datas'));
    }
    public function login_guest()
    {
        return view('auth/login_guest');
    }

}
