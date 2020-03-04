@extends('layouts.app')

@section('content')

<div class="container">
    <h1>編輯產品</h1>
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
            <label for="category">category</label>
            <select id="select_dropdown" multiple class="form-control" id="category" name='category' data-category="{{$product->category}}">
                <option>A</option>
                <option>B</option>
                <option>C</option>
                <option>D</option>
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
