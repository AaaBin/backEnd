@extends('layouts/nav')

@section('css')
<style>
    .Cart {
        padding: 120px 0;
        margin: 50px auto;
    }

    .Cart__header {
        display: grid;
        grid-template-columns: 3fr 1fr 1fr 1fr 1fr 1fr 1fr;
        grid-gap: 2px;
        margin-bottom: 2px;
    }

    .Cart__headerGrid {
        text-align: center;
        background: #f3f3f3;
    }

    .Cart__product {
        display: grid;
        grid-template-columns: 5fr 4fr 3fr 3fr 3fr 3fr 3fr 3fr;
        grid-gap: 2px;
        margin-bottom: 2px;
    }

    .Cart__price_info {
        display: grid;
        grid-template-columns: 7fr 3fr;
        grid-gap: 2px;
        margin-bottom: 2px;
    }

    .Cart__productGrid {
        padding: 5px;
    }

    .Cart__productImg {
        /* background-image: url(https://fakeimg.pl/640x480/c0cfe8/?text=Img); */
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .Cart__productTitle {
        overflow: hidden;
        line-height: 25px;
    }

    .Cart__productPrice,
    .Cart__productQuantity,
    .Cart__productTotal,
    .Cart__productDel {
        text-align: center;
        line-height: 60px;
    }

    @media screen and (max-width: 820px) {
        .Cart__header {
            display: none;
        }

        .Cart__product {
            box-shadow: 2px 2px 3px 0 rgba(0, 0, 0, 0.5);
            margin-bottom: 10px;
            grid-template-rows: 1fr 1fr;
            grid-template-columns: 2fr 2fr 2fr 2fr 2fr 2fr 1fr;
            grid-template-areas:
                "img title title title title title del"
                "img price price quantity total total del";
        }

        .Cart__productImg {
            grid-area: img;
        }

        .Cart__productTitle {
            grid-area: title;
        }

        .Cart__productPrice,
        .Cart__productQuantity,
        .Cart__productTotal,
        .Cart__productDel {
            line-height: initial;
        }

        .Cart__productPrice {
            grid-area: price;
            text-align: right;
        }

        .Cart__productQuantity {
            grid-area: quantity;
            text-align: left;
        }

        .Cart__productQuantity::before {
            content: "x";
        }

        .Cart__productTotal {
            grid-area: total;
            text-align: right;
            color: red;
        }

        .Cart__productDel {
            grid-area: del;
            line-height: 60px;
            background: #ffc0cb26;
        }
    }
</style>

@endsection

@section('content')
<div class="container">
    <div class="Cart d-flex flex-column">
        <h2>Shopping Cart</h2>
        <div class="Cart__header">
            <div class="Cart__headerGrid">商品</div>
            <div class="Cart__headerGrid">單價</div>
            <div class="Cart__headerGrid">數量</div>
            <div class="Cart__headerGrid">顏色</div>
            <div class="Cart__headerGrid">容量</div>
            <div class="Cart__headerGrid">小計</div>
            <div class="Cart__headerGrid">刪除</div>
        </div>
        @foreach ($items as $item)
        <div class="Cart__product" data-rowId="{{$item->id}}">
            <div class="Cart__productGrid Cart__productImg">
                <img src="/storage/{{$item->associatedModel->url}}" alt="" style="width:100%;">
            </div>
            <div class="Cart__productGrid Cart__productTitle">
                {{$item->name}}
            </div>
            <div class="Cart__productGrid Cart__productPrice">
                {{$item->price}}
            </div>
            <div class="Cart__productGrid Cart__productQuantity">
                <span class="btn btn-sm p-1 btn-primary m-0" onclick="minus_item({{$item->id}})">-</span>
                <span class="qty">{{$item->quantity}}</span>
                <span class="btn btn-sm p-1 btn-primary m-0" onclick="plus_item({{$item->id}})">+</span>
            </div>
            <div class="Cart__productGrid Cart__productQuantity">
                {{$item->attributes->color}}
            </div>
            <div class="Cart__productGrid Cart__productQuantity">
                {{$item->attributes->capcity}}
            </div>
            <div class="Cart__productGrid Cart__productTotal">
                {{$item->price * $item->quantity}}
            </div>
            <div class="Cart__productGrid text-center" >
                <div class="btn btn-danger p-2" onclick="delete_item({{$item->id}})">X</div>
            </div>
        </div>
        @endforeach
        <div class="Cart__price_info mb-3">
            <div class="box"></div>
            <div class="pricing_box">
                <?php
                    if (\Cart::session($id)->getTotal() > 1200) {
                        $shipment_price = 0;
                    } else {
                        $shipment_price = 150;
                    }

                ?>
                <div class="p-1">product price: {{\Cart::session($id)->getTotal()}} $</div>
                <div class="p-1 ">shipment price{{$shipment_price}}$</div>
                <div class="p-1 ">Total price: {{\Cart::session($id)->getTotal() + $shipment_price}} $</div>
            </div>
        </div>
        <div class="text-center">
            <a href="/product" class="btn btn-primary btn-sm">繼續購物</a>
        </div>




        <form method="POST" class="recipient_form pt-5 mt-5" action="/checkout">
            @csrf
            <h3>recipient info</h3>
            <div class="form-group ">
                <label class="p-1" for="recipient_name">Recipient Name:</label>
                <input id="recipient_name" class="form-control" type="text" name="recipient_name">
            </div>
            <div class="form-group ">
                <label class="p-1" for="recipient_phone">Recipient Phone:</label>
                <input id="recipient_phone" class="form-control" type="text" name="recipient_phone">
            </div>
            <div class="form-group ">
                <label class="p-1" for="recipient_email">Recipient Email:</label>
                <input id="recipient_email" class="form-control" type="text" name="recipient_email">
            </div>
            <div class="form-group ">
                <label class="p-1" for="recipient_address">Recipient Address:</label>
                <input id="recipient_address" class="form-control" type="text" name="recipient_address">
            </div>
            <div class="text-center">
                <button class="btn btn-primary btn-sm m-5 px-5">結帳</button>
            </div>
        </form>




    </div>
</div>
@endsection


@section('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    function delete_item(productID){
        var r=confirm("do you really want to delete this item?");
        if (r==true)
        {
            $.ajax({
                type:"POST",
                url:`/delete_item/${productID}`,
                data:{},
                success:function(result){
                    console.log(result);
                    $(`div[data-rowId=${productID}]`)[0].remove();
                    location.reload();
                }
            });
        }
        else
        {
        }
    }


    function minus_item(productID){
            $.ajax({
            type:"POST",
            url:`/update_cart/${productID}`,
            // 送出的值為id
            data:{qty:-1},
            success:function(result){
                console.log(result);

                location.reload();
            }
            });
    }


    function plus_item(productID){
            $.ajax({
            type:"POST",
            url:`/update_cart/${productID}`,
            // 送出的值為id
            data:{qty:1},
            success:function(result){
                console.log(result);

                location.reload();
            }
            });
    }
</script>



@endsection
