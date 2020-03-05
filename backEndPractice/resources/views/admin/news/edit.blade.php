@extends('layouts.app')

@section('content')

<div class="container">
    <h1>編輯最新消息</h1>
    <form method="POST" action="/home/news/update/{{$news->id}}" enctype="multipart/form-data" >
        {{-- 傳入的資料為物件型態 --}}
        {{-- {{$news}} --}}
        @csrf
        <span>
            舊圖片:
        <img width="250px" src="/storage/{{$news->url}}" alt="">
        </span>
        <div class="form-group">
        <label for="url">upload new img</label>
        {{-- 將選擇到的表單內容寫入預設值value --}}
        <input type="file" class="form-control" id="url" name="url">
        </div>
        <hr>
        <div class="row">
            現有圖片:

            @foreach ($news->news_imgs as $item)
            <div class="col-3">
                    <img class="img-fluid" src="/storage/{{$item->img_url}}" alt="">
            </div>
            @endforeach

        </div>
        <hr>
        <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{$news->title}}">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea  class="form-control" name="content" id="content" cols="30" rows="10">{{$news->content}}</textarea>
        </div>
        <div class="form-group">
            <label for="sort">權重</label>
            <input type="number" min="0" style="width:100px" class="form-control" id="sort" name="sort" value="{{$news->sort}}">
            <small id="sort_help" class="form-text text-muted">數字越大排序越前，預設值為0</small>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>





@endsection
