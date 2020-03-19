@extends('layouts.app')

@section('css')
{{-- 接入css --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

@endsection


@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">聯絡資訊</li>
        </ol>
    </nav>
    <a href="/home/news/create" class="btn btn-success">新增最新消息</a>
    <hr>
    <table id="example" class="table table-striped table-bordered" style="width:100%">

        <thead>
            <tr>
                <th>created_at</th>
                <th>name</th>
                <th>email</th>
                <th>phone</th>
                <th id="test">question</th>
                <th>SendMeMail</th>
                <th width='80'></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($contact_datas as $item)
            <tr>
                <td>{{$item->created_at}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->phone}}</td>
                <td >{{$item->question}}</td>
                <td >{{$item->SendMeMail}}</td>

                <td>
                    <a href="#" class="btn col-12 btn-block btn-sm btn-danger"
                        onclick="event.preventDefault();show_confirm(`{{$item->id}}`)">刪除</a>
                    <form id="delete_form{{$item->id}}" action="/home/contact/delete/{{$item->id}}" method="POST"
                        style="display: none;">
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

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "order": [[ 0, "desc" ]]
            });
        });
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
