@extends('layouts.app')

@section('css')
{{-- 接入css --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

@endsection


@section('content')
<div class="container">
    <a href="/home/product/create"  class="btn btn-success">新增產品</a>
    <hr>
    <table id="example" class="table table-striped table-bordered" style="width:100%">

            <thead>
                <tr>
                    <th>img</th>
                    <th>category</th>
                    <th>權重</th>
                    <th width='80'></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($all_product as $item)
                <tr>
                    <td>
                        <img width="100" src="/storage/{{$item->url}}" alt="" class="m-auto">
                    </td>
                    <td>{{$item->category}}</td>
                    <td>{{$item->sort}}</td>
                    <td >
                        <a href="/home/product/edit/{{$item->id}}" class="btn col-12 btn-block btn-sm btn-primary">修改</a>
                        {{-- 點擊連結→觸發js事件→中斷連結的事件進行，執行指定函式 --}}
                        <a href="#" class="btn col-12 btn-block btn-sm btn-danger" onclick="event.preventDefault();show_confirm(`{{$item->id}}`)">刪除</a>
                        <form id="delete_form{{$item->id}}" action="/home/product/delete/{{$item->id}}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>


    </table>
</div>





@endsection

@section('js')
    {{-- 接入js，並初始化datatables套件 --}}
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script >
        $(document).ready(function() {
        $('#example').DataTable({
            "order": [[ 2, "desc" ]]
            });
        } );
    </script>

    <script>
        // confirm函式，跳出視窗警告使用者正在進行刪除行為，若確認，則送出隱藏的表單，執行刪除
        function show_confirm(k){
            let r = confirm("你即將刪除這筆最新消息!");
            if (r == true){
                document.querySelector(`#delete_form${k}`).submit();
            }
        }
    </script>
@endsection
