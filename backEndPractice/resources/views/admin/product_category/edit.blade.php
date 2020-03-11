@extends('layouts.app')

@section('css')
<style>
    .sub_img_card button {
        border-radius: 50%;
        position: absolute;
        right: -15px;
        top: -15px;
        font-size: 15px;
    }
</style>
@endsection
@section('content')

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="/home/productCategory">產品類別列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">編輯產品類別:{{$product_category->name}}</li>
        </ol>
    </nav>
    <h2>編輯商品類別</h2>
    <hr>
    <form method="POST" action="/home/productCategory/update/{{$product_category->id}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$product_category->name}}">
        </div>
        <div class="form-group">
            <label for="sort">權重</label>
            <input type="number" min="0" style="width:100px" class="form-control" id="sort" name="sort"
                value="{{$product_category->sort}}">
            <small id="sort_help" class="form-text text-muted">數字越大排序越前，預設值為0</small>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
@endsection
