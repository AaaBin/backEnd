@extends('layouts.app')

@section('content')

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="/home/product">產品列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增產品</li>
        </ol>
    </nav>
    <h1>新增產品</h1>
    <small>預設權重為0，若須修改請於新增完成後再修改</small>
    {{-- 上傳的表格有檔案時須增加enctype="multipart/form-data" --}}
    <hr>
    <form method="POST" action="/home/product/store"  enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="url">upload img</label>
            <input type="file" class="form-control" id="url" name="url" required>
            {{-- required屬性確保表單有填入資料時才可送出 --}}
        </div>
        <div class="form-group">
            <label for="name">item name</label>
            <input  class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="price">item price</label>
            <input type="number" min="0" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="category">category</label>
            <select class="form-control" id="category" name='category' required>
                @foreach ($cotegories as $item)
                    <option>{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>





@endsection
