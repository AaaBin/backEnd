@extends('layouts.app')

@section('content')

<div class="container">
    <h1>新增最新消息</h1>
    <small>預設權重為0，若須修改請於新增完成後再修改</small>
    <hr>
    {{-- 上傳的表格有檔案時須增加enctype="multipart/form-data" --}}
    <form method="POST" action="/home/news/store" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="url">upload img</label>
            <input type="file" class="form-control" id="url" name="url" required>
            {{-- required屬性確保表單有填入資料時才可送出 --}}
        </div>
        <div class="form-group">
            <label for="sub_img">upload sub_img</label>
            <input type="file" class="form-control" id="sub_img" name="sub_img[]" multiple>
            {{-- required屬性確保表單有填入資料時才可送出 --}}
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>





@endsection
