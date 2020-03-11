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
            <li class="breadcrumb-item active" aria-current="page">最新消息</li>
        </ol>
    </nav>
    <a href="/home/news/create" class="btn btn-success">新增最新消息</a>
    <hr>
    <table id="example" class="table table-striped table-bordered" style="width:100%">

        <thead>
            <tr>
                <th>img</th>
                <th>title</th>
                <th>content</th>
                <th id="test">權重</th>
                <th width='100'>權重順序</th>
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
                <td>{!!$item->content!!}</td>
                <td data-sort_id='{{$item->id}}'>{{$item->sort}}</td>
                <td>
                    <a href="#" type="button" class="btn btn-outline-info btn-sm col-12 btn-block" onclick="sort_up({{$item->sort}},{{$item->id}})">Up</a>
                    <a  data-btn_id="{{$item->id}}" href="#" type="button" class="btn btn-outline-info btn-sm col-12 btn-block"
                        onclick="too_small({{$item->sort}},{{$item->id}});test({{$item->id}})">Down</a>

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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    function test(d){
        let sort_value_now = $(`td[data-sort_id=${d}]`)[0].innerHTML;
        console.log(sort_value_now);
    }

    // 在index頁更改sort時，及時更新畫面排序
    function too_small(i,k){
        let sort_value_now = $(`td[data-sort_id=${k}]`)[0].innerHTML;
        console.log(sort_value_now);
        // onclick時，傳來現有索引值跟動作物件的id，判斷若索引值小於1，則跳出警告，不進行更改
        if (sort_value_now < 1) {
            alert("the min. sort value is 0,cann't be smaller");
        } else {
            // 若索引值大於1，以ajax送出資料(post)
            $.ajax({
            type:"POST",
            url:`/home/news/edit/sort_down`,
            // 送出的值為點擊到的這筆資料的id
            data:{data_id:k},
            success:function(result){
                console.log(result);
                // 那麼就只需要抓到被點擊到的資料是哪一筆，並以innerHTML的方法更改「網頁中」sort欄位的值
                let on_change_sort = $(`td[data-sort_id=${k}]`)[0];
                on_change_sort.innerHTML = result[0];
                // 若有第三筆，則是代表這次的動作是兩筆資料的索引值互換，第三筆資料為互換對象的id
                // 所以要抓到互換索引值的對象，並同樣以innerHTML的方法更改「網頁中」sort欄位的值
                if (result.length == 3){
                    let target_id = result[2];
                    let on_change_sort2 = $(`td[data-sort_id=${target_id}]`)[0];
                    on_change_sort2.innerHTML = result[1];
                }

                // 最後重新將datatable初始化，以達成即時重新排序的目的
                $('#example').DataTable({
                "order": [[ 3, "desc" ]],
                // 初始化須加上destroy:true，讓datatable將資料刪除重來
                destroy:true,
                });
            }
            });
        }
    }


    function sort_up(i,k){
            // 若索引值大於1，以ajax送出資料(post)
            $.ajax({
            type:"POST",
            url:`/home/news/edit/sort_up`,
            // 送出的值為id
            data:{data_id:k},
            success:function(result){
                // console.log("success",result);
                let on_change_sort = $(`td[data-sort_id=${k}]`)[0];
                on_change_sort.innerHTML = result[0];
                let target_id = result[2];

                if (result.length == 3){
                    let on_change_sort2 = $(`td[data-sort_id=${target_id}]`)[0];
                    on_change_sort2.innerHTML = result[1];
                }


                $('#example').DataTable({
                "order": [[ 3, "desc" ]],
                destroy:true,
                });
            }
            });
    }
</script>

@endsection
