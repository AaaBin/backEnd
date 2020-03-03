@extends('layouts.app')

@section('content')

<div class="container">
    <h1>編輯最新消息</h1>
    <form method="POST" action="/home/news/update/{{$news->id}}">
        {{-- 傳入的資料為物件型態 --}}
        {{-- {{$news}} --}}
        @csrf
        <div class="form-group">
        <label for="url">img address</label>
        {{-- 將選擇到的表單內容寫入預設值value --}}
        <input type="text" class="form-control" id="img" name="url" value="{{$news->url}}">
        </div>
        <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{$news->title}}">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea  class="form-control" name="content" id="content" cols="30" rows="10">{{$news->content}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>





@endsection
