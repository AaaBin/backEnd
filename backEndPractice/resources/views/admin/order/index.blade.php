@extends('layouts.app')

@section('css')
{{-- 接入css --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

@endsection


@section('content')

<div class="container">
    <h2>I'm not ok</h2>
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
