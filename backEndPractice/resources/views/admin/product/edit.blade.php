@extends('layouts.app')

@section('content')

<div class="container" >

    <form method="POST" action="/home/product/update/{{$product->id}}">
        @csrf
        <div class="form-group">
        <label for="url">img address</label>
        <input type="text" class="form-control" id="img" name="url" value="{{$product->url}}">
        </div>
        <div class="form-group">
            <label for="category">category</label>
            <select multiple class="form-control" id="category" name='category'>
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
        dropdown.forEach(function(i) {
            console.log(i.innerHTML);
            let dropdownValue = i.innerHTML;
            if(dropdownValue == ){
                console.log("123");
            }
        });

    </script>
@endsection
