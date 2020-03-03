<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $all_product = Product::all();
        return view('admin/product/index',compact('all_product'));
    }
    public function store(Request $request)
    {
        $product_data = $request->all();
        Product::create($product_data)->save();
        return redirect('/home/product');
    }
    public function create()
    {
        return view('admin/product/create');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin/product/edit',compact('product'));
    }
    public function update(Request $request,$id)
    {
        Product::find($id)->update($request->all());
        return redirect("home/product");
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        return redirect("home/product");
    }


}
