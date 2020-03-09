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
