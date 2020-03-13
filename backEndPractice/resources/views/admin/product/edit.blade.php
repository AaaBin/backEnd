@extends('layouts.app')

@section('content')

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="/home/product">產品列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">編輯產品:{{$product->name}}</li>
        </ol>
    </nav>
    <h2>編輯最新消息</h2>
    <hr>
    <form method="POST" action="/home/product/update/{{$product->id}}" enctype="multipart/form-data">
        @csrf
        <span>
            舊圖片:
        <img width="250px" src="/storage/{{$product->url}}" alt="">
        </span>
        <div class="form-group">
        <label for="url">upload new img</label>
        <input type="file" class="form-control" id="url" name="url">
        </div>
        <div class="form-group">
            <label for="name">item name</label>
            <input  class="form-control" id="name" name="name" value="{{$product->name}}" required>
        </div>
        <div class="form-group">
            <label for="price">item price</label>
            <input type="number" min="0" class="form-control" id="price" name="price" value="{{$product->price}}" required>
        </div>
        <div class="form-group">
            <label for="category">category</label>
            <select id="select_dropdown"  class="form-control" id="category" name='category' data-category="{{$product->category}}">
                @foreach ($cotegories as $item)
                    <option>{{$item['name']}}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="sort">權重</label>
            <input type="number" min="0" style="width:100px" class="form-control" id="sort" name="sort" value="{{$product->sort}}">
            <small id="sort_help" class="form-text text-muted">數字越大排序越前，預設值為0</small>
            </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>





@endsection


@section('js')
    <script>
        let dropdown = document.querySelectorAll("option");
        let judge_value = document.querySelector("#select_dropdown").getAttribute("data-category");

        dropdown.forEach(function(e,i) {
            console.log(e.innerHTML);
            let categoryValue = e.innerHTML;
            if(categoryValue == judge_value){
                dropdown[i].setAttribute("selected","");
            }
        });

    </script>
@endsection
