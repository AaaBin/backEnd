@extends('layouts.app')

@section('content')

<div class="container">
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
            <label for="category">category</label>
            <select multiple class="form-control" id="category" name='category' required>
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
