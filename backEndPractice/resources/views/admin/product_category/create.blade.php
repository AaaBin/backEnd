@extends('layouts.app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="/home/productCategory">產品類別列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增產品類別</li>
        </ol>
    </nav>
    <h1>新增產品類別</h1>
    <small>預設權重為0，若須修改請於新增完成後再修改</small>
    <hr>
    {{-- 上傳的表格有檔案時須增加enctype="multipart/form-data" --}}
    <form method="POST" action="/home/productCategory/store" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="sort">Sort</label>
            <input type="number" min="0" class="form-control" name="sort" id="sort" cols="30" rows="10"
                required style="width:100px" value="0">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

@endsection

@section('js')

@endsection
