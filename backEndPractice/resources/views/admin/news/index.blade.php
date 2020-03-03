@extends('layouts.app')

@section('css')
{{-- 接入css --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

@endsection


@section('content')
<div class="container">
    <a href="/home/news/create"  class="btn btn-success">新增最新消息</a>
    <hr>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        
            <thead>
                <tr>
                    <th>img</th>
                    <th>title</th>
                    <th>content</th>
                    <th width='80'></th>
                </tr>
            </thead>

        @foreach ($all_news as $item)
            <tbody>
                <tr>
                    <td>
                        <img width="100" src="{{$item->url}}" alt="" class="m-auto">
                    </td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->content}}</td>
                    <td >
                        <a href="/home/news/edit/{{$item->id}}" class="btn col-12 btn-block btn-sm btn-primary">修改</a>
                        <a href="/home/news/delete/{{$item->id}}" class="btn col-12 btn-block btn-sm btn-danger">刪除</a>
                    </td>
                </tr>
            </tbody>
        @endforeach

    </table>
</div>





@endsection

@section('js')
    {{-- 接入js，並初始化datatables套件 --}}
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script >
        $(document).ready(function() {
        $('#example').DataTable();
        } );
    </script>
@endsection
