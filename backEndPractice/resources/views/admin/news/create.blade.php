@extends('layouts.app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="/home/news">最新消息</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增最新消息</li>
        </ol>
    </nav>
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
            <textarea id="summernote" class="form-control" name="content" id="content" cols="30" rows="10"
                required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

@endsection

@section('js')
{{-- summernote --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
{{-- summernote語言包 --}}
<script src="{{asset('js/summernote-zh-TW.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            minHeight:300,
            lang: 'zh-TW', //更改語言
            callbacks: {
                    onImageUpload: function(files) {
                        for(let i=0; i < files.length; i++) {
                            $.upload(files[i]);
                        }
                    },
                    onMediaDelete : function(target) {
                        $.delete(target[0].getAttribute("src"));
                    }
                },
        });

        $.upload = function (file) {
            let out = new FormData();  //建立formdata來讓ajax有表單資料可以送出
            out.append('file', file, file.name);  //append( name , value , (filename) )

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: '/home/news/ajax_upload_img',
                contentType: false,
                cache: false,
                processData: false,
                data: out,
                success: function (img) {
                    $('#summernote').summernote('insertImage', img);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        };

        $.delete = function (file_link) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: '/admin/ajax_delete_img',
                data: {file_link:file_link},
                success: function (img) {
                    console.log("delete:",img);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        }
    });
</script>
@endsection
