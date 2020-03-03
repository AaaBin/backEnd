@extends('layouts.app')

@section('content')

<div class="container">

    <form method="POST" action="/home/product/update/{{$product->id}}" >
        @csrf
        <div class="form-group">
        <label for="url">img address</label>
        <input type="text" class="form-control" id="img" name="url" value="{{$product->url}}">
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
