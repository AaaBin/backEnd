<?php

namespace App\Http\Controllers;

// 略過model直接使用database
use DB;
use App\News;
use App\Order;
use App\Product;
use Carbon\Carbon;
use App\Order_detail;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use TsaiYiHua\ECPay\Checkout;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use TsaiYiHua\ECPay\Services\StringService;


class FrontController extends Controller
{
    protected $checkout;

    public function __construct(Checkout $checkout)
    {
        $this->checkout = $checkout;
    }




    // permission test
    public function createRoleAndPermission()
    {
        $admin_role = Role::create(['name' => 'admin']); //建立role:admin
        $admin_permission = Permission::create(['name' => 'do every thing']);  //建立permission
        $admin_role->givePermissionTo($admin_permission); //將role與permission關聯

        $normal_role = Role::create(['name' => 'normal_user']); //建立role:normal
        $normal_permission = Permission::create(['name' => 'a normal user']);
        $normal_role->givePermissionTo($normal_permission);
    }
    public function assignRole()
    {
        $user = Auth::user(); //將現在使用者套用上admin這一role
        $user->assignRole('admin');
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
        $current_time = Carbon::now()->format('mdY');  //current time
        if (\Cart::session($id)->getTotal() > 1200) {
            $shipment_price = 0;
        } else {
            $shipment_price = 150;
        }
        // store data into order
        //依照資料表的欄位將資料填入並儲存，注意!有關價錢的部分要從Cart套件甚至是後端的資料庫中拿取
        //才不會有從前台被竄改資料的可能
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

        $order_data->order_no = "AaaBin".$current_time.$order_id; //產生訂單編號，要是唯一值
        $order_data->save();
        $OrderId = $order_data->order_no;
        $product_details = [];  //建立一個空array，準備要填入訂單中的詳細物品清單，以傳給ECPay
        // store data into order_detail
        foreach ($items as $key => $item) {
            $order_detail_data = new Order_detail;
            $order_detail_data->order_id = $order_id;
            $order_detail_data->product_id = $item['id'];
            $order_detail_data->price = $item['price'];
            $order_detail_data->quantity = $item['quantity'];
            $order_detail_data->save();
            $product_data = Product::find($order_detail_data->product_id);

            $product_detail = [   //傳給ECPay的型態要是二維陣列
                'name' => $product_data->name,
                'qty' => $order_detail_data->quantity,
                'unit' => '個',
                'price' => $order_detail_data->price
            ];
            array_push($product_details,$product_detail); //用array push的方式將資料填入array
        }
        // 運費的資料也要傳入訂單中，才會計算進total price
        if ($shipment_price == 0) {
            $shipment_detail = [
                'name' =>"shipment price",
                'qty' => 0,
                'unit' => '筆',
                'price' =>$shipment_price
            ];
        } else {
            $shipment_detail = [
                'name' =>"shipment price",
                'qty' => 1,
                'unit' => '筆',
                'price' =>$shipment_price
            ];
        }
        array_push($product_details,$shipment_detail); //將運費項目加進array

        $formData = [
            'UserId' => 1, // 用戶ID , Optional
            'ItemDescription' => '產品簡介',
            'OrderId' => $OrderId,
            'Items' => $product_details,
            // 'ItemName' => 'Product Name',
            // 'TotalAmount' => '2000',
            'PaymentMethod' => 'Credit', // ALL, Credit, ATM, WebATM
        ];

        \Cart::session($id)->clear();  //清空購物車

        return $this->checkout->setNotifyUrl(route('notify'))->setReturnUrl(route('return'))->setPostData($formData)->send();
    }

    public function notifyUrl(Request $request){
        $serverPost = $request->post();
        $checkMacValue = $request->post('CheckMacValue');
        unset($serverPost['CheckMacValue']);
        $checkCode = StringService::checkMacValueGenerator($serverPost);
        if ($checkMacValue == $checkCode) {
            return '1|OK';
        } else {
            return '0|FAIL';
        }
    }
    public function returnUrl(Request $request){
        $serverPost = $request->post();
        $checkMacValue = $request->post('CheckMacValue');
        unset($serverPost['CheckMacValue']);
        $checkCode = StringService::checkMacValueGenerator($serverPost);
        if ($checkMacValue == $checkCode) {
            if (!empty($request->input('redirect'))) {
                return redirect($request->input('redirect'));
            } else {

                //付款完成，下面接下來要將購物車訂單狀態改為已付款

                $order_no = $serverPost["MerchantTradeNo"];
                $order = Order::where('order_no',$order_no)->first();
                $order->payment_status = "已完成";
                $order->save();
                return "555";
            }
        }
    }


}
