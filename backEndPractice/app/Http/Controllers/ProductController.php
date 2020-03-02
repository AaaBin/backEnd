<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('product/product');
    }

    public function store(Request $request)
    {
        $product_data = $request->all();
        Product::create($product_data)->save();
        return redirect('/home/product');
    }
}
