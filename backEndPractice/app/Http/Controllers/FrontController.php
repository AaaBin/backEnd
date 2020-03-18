<?php

namespace App\Http\Controllers;

// 略過model直接使用database
use DB;
use App\News;
use App\Order;
use App\Order_detail;
use App\Product;
use Carbon\Carbon;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class FrontController extends Controller
{
    // permission test
    public function adminPermission()
    {
        $admin_role = Role::create(['name' => 'admin']);
        $admin_permission = Permission::create(['name' => 'do every thing']);
        $admin_role->givePermissionTo($admin_permission);
    }
    public function NormalPermission()
    {
        $normal_role = Role::create(['name' => 'normal_user']);
        $normal_permission = Permission::create(['name' => 'a normal user']);
        $normal_role->givePermissionTo($normal_permission);
    }
    public function assignRole()
    {
        $user = Auth::user();
        $user->assignRole('admin');
    }
    public function getPermissionName()
    {
        $user = Auth::user();
        $RoleNames = $user->getRoleNames();
        dd($RoleNames);
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

    public function add_cart(Request $request)
    {
        $request_data = $request->all();
        $Product = Product::find($request_data['productID']); // assuming you have a Product model with id, name, description & price
        $rowId = $Product->id; // generate a unique() row ID
        $userID = Auth::user()->id; // the user ID to bind the cart contents

        \Cart::session($userID)->add(array(
            'id' => $rowId,
            'name' => $Product->name,
            'price' => $Product->price,
            'quantity' => $request_data['qty'],

            'attributes' => array(
                'color' => $request_data['color'],
                'capcity' => $request_data['capcity'],
            ),

            'associatedModel' => $Product,
        ));

        return redirect('/shoppingcart');
    }

    public function shoppingcart()
    {
        if (Auth::user()) {
            $id = Auth::user()->id;
            $items = \Cart::session($id)->getContent()->sort();

            return view('front/shopping_cart', compact('items','id'));
        } else {
            return redirect('/');
        }

    }


    public function update(Request $request,$productID)
    {
        $request_data = $request->all();
        $id = Auth::user()->id;
        \Cart::session($id)->update($productID, array(
            'quantity' => $request_data['qty'],
          ));
        //   return [$request_data,$id,$productID];
    }
    public function deleteItem($productID)
    {
        $id = Auth::user()->id;
        \Cart::session($id)->remove($productID);
        return "success";
    }

    public function checkout(Request $request)
    {
        $id = Auth::user()->id;
        $request_data = $request->all();
        $items = \Cart::session($id)->getContent();
        $current_time = Carbon::now();  //current time
        if (\Cart::session($id)->getTotal() > 1200) {
            $shipment_price = 0;
        } else {
            $shipment_price = 150;
        }
        // store data into order
        $order_data = new Order;
        $order_data->user_id = $id;
        $order_data->recipient_name = $request_data['recipient_name'];
        $order_data->recipient_phone = $request_data['recipient_phone'];
        $order_data->recipient_address = $request_data['recipient_address'];
        $order_data->recipient_email = $request_data['recipient_email'];
        $order_data->total_price =\Cart::session($id)->getTotal() + $shipment_price;
        $order_data->order_time =$current_time;
        $order_data->payment_status = "no";
        $order_data->send_status ="no";
        $order_data->save();
        $order_id = $order_data->id;

        // store data into order_detail
        foreach ($items as $key => $item) {
            $order_detail_data = new Order_detail;
            $order_detail_data->order_id = $order_id;
            $order_detail_data->product_id = $item['id'];
            $order_detail_data->price = $item['price'];
            $order_detail_data->quantity = $item['quantity'];
            $order_detail_data->save();
        }
    }


}
