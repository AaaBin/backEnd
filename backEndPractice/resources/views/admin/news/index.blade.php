@extends('layouts.app')

@section('css')
{{-- 接入css --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

@endsection


@section('content')
<div class="container">
    <a href="/home/news/create" class="btn btn-success">新增最新消息</a>
    <hr>
    <table id="example" class="table table-striped table-bordered" style="width:100%">

        <thead>
            <tr>
                <th>img</th>
                <th>title</th>
                <th>content</th>
                <th>權重</th>
                <th width='100'>權重順訊</th>
                <th width='80'></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($all_news as $item)
            <tr>
                <td>
                    {{-- 上傳的檔案會以類似連結的形式出現在public/storage內 --}}
                    <img width="120px" src="/storage/{{$item->url}}" alt="">
                </td>
                <td>{{$item->title}}</td>
                <td>{{$item->content}}</td>
                <td>{{$item->sort}}</td>
                <td>
                    <a href="/home/news/edit/sort_up/{{$item->id}}" type="button"
                        class="btn btn-outline-info btn-sm col-12 btn-block">Up</a>
                    <a href="#" type="button" class="btn btn-outline-info btn-sm col-12 btn-block" onclick="too_small({{$item->sort}},{{$item->id}})">Down</a>
                    {{-- 隱藏一個link，若sort值大於0則送出 --}}
                    <a id="sort_down_link{{$item->id}}" href="/home/news/edit/sort_down/{{$item->id}}" type="button" class="btn btn-outline-info btn-sm col-12 btn-block" onclick="too_small({{$item->sort}})" style="display: none;"></a>

                </td>
                <td>
                    <a href="/home/news/edit/{{$item->id}}" class="btn col-12 btn-block btn-sm btn-primary">修改</a>

                    {{-- 點擊連結→觸發js事件→中斷連結的事件進行，執行指定函式 --}}
                    <a href="#" class="btn col-12 btn-block btn-sm btn-danger"
                        onclick="event.preventDefault();show_confirm(`{{$item->id}}`)">刪除</a>
                    <form id="delete_form{{$item->id}}" action="/home/news/delete/{{$item->id}}" method="POST"
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
            "order": [[ 3, "desc" ]]
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

<script>
    function too_small(i,k){
        if (i < 1) {
            alert("the min. sort value is 0,cann't be smaller");
        } else {
            $target = document.querySelector(`#sort_down_link${k}`);
            $target.click();
        }
    }
</script>
@endsection
