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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="/home/news">最新消息</a></li>
            <li class="breadcrumb-item active" aria-current="page">修改最新消息:{{$news->title}}</li>
        </ol>
    </nav>
    <h2>編輯最新消息</h2>
    <hr>
    <form method="POST" action="/home/news/update/{{$news->id}}" enctype="multipart/form-data">
        {{-- 傳入的資料為物件型態 --}}
        {{-- {{$news}} --}}
        @csrf
        <div class="">
            <p>現有的主圖片:</p>
            <img class="rounded p-3 bg-secondary" width="500px" src="/storage/{{$news->url}}" alt="">
        </div>
        <div class="form-group">
            <label for="url">upload new img</label>
            {{-- 將選擇到的表單內容寫入預設值value --}}
            <input type="file" class="form-control" id="url" name="url">
        </div>
        <hr>
        <p>現有的副圖片:</p>
        <div id="sub_img_edit" class="d-flex align-items-start flex-wrap">
            @foreach ($news_imgs as $item)

            <div  class="sub_img_card col-2 bg-secondary mx-2 p-3 rounded form-group"  data-sub_img="{{$item->id}}">
                <button  type="button" class='btn btn-danger' onclick="ajax_delete_sub_img({{$item->id}})">X</button>
                <img class="img-fluid  rounded" src="/storage/{{$item->img_url}}" alt="">
                <input data-sort_id="{{$item->id}}" type="number" min="0" class="form-control" value="{{$item->sort}}" name="sub_img_sort{{$item->id}}" >

            </div>
            @endforeach
        </div>
        <div class="form-group">
            <div class="form-group">
                <label for="sub_img">upload new sub img</label>
                <input type="file" class="form-control" id="sub_img" name="sub_img[]" multiple>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$news->title}}">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{$news->content}}</textarea>
        </div>
        <div class="form-group">
            <label for="sort">權重</label>
            <input type="number" min="0" style="width:100px" class="form-control" id="sort" name="sort"
                value="{{$news->sort}}">
            <small id="sort_help" class="form-text text-muted">數字越大排序越前，預設值為0</small>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
@endsection


@section('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function ajax_delete_sub_img(k){
        $.ajax({
        type:"POST",
        url:`/home/news/delete_news_sub_img`,
        data:{sub_img_id:k},
        success:function(result){
            $delete_target = $(`div[data-sub_img=${result}]`)[0];
            $delete_target.remove();
        }
        });
    }
</script>

<script>

    $('.sub_img_card input').change(function(){
        let sort_id = this.getAttribute('data-sort_id');
        let sort_value = this.value;

        $.ajax({
        type:"POST",
        url:`/home/news/change_sub_img_sort`,
        data:{
            sub_img_id:sort_id,
            changed_value:sort_value
            },
        success:function(result){
            location.reload();
            // $('#sub_img_edit').load(document.URL +  ' #sub_img_edit');  //只作用一次 = =
        }
        });
    })


</script>
@endsection
