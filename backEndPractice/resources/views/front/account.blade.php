@extends('layouts/nav')

@section('css')
{{-- data table --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

<style>
    div.dataTables_wrapper div.dataTables_length select {
        width: 60px;
    }

</style>

@endsection


@section('content')
<div class="container " style="padding:120px 0 ;min-height:100vh;">
    <h2>Account</h2>
    <div class="row pl-3">
        <p>User Name : {{$user->name}}</p>
    </div>
    <div class="row pl-3">
        <p>User Role : {{$user->role}}</p>
    </div>
    <div class="row p-3">
        <p>Order :</p>
    </div>
    <table id="account_table" class="table table-striped table-bordered" style="width:100%">

        <thead>
            <tr>
                <th>Order No</th>
                <th>Recipient Name</th>
                <th>Recipient Phone</th>
                <th>Recipient Address</th>
                <th>Recipient Email</th>
                <th>Total Price</th>
                <th>Payment Status</th>
                <th>Send Status</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($order_datas as $key=>$order_data)
            <tr>
                <td>{{$order_data->order_no}}</td>
                <td>{{$order_data->recipient_name}}</td>
                <td>{{$order_data->recipient_phone}}</td>
                <td>{{$order_data->recipient_address}}</td>
                <td>{{$order_data->recipient_email}}</td>
                <td>{{$order_data->total_price}}</td>
                <td>{{$order_data->payment_status}}</td>
                <td>{{$order_data->send_status}}</td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>


@endsection


@section('js')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#account_table').DataTable({
            "order": [[ 0, "desc" ]]
            });
        });
</script>
@endsection
