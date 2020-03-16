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
        grid-template-columns: 2fr 7fr 3fr 3fr 3fr 3fr 3fr 3fr;
        grid-gap: 2px;
        margin-bottom: 2px;
    }

    .Cart__productGrid {
        padding: 5px;
    }

    .Cart__productImg {
        background-image: url(https://fakeimg.pl/640x480/c0cfe8/?text=Img);
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
    <div class="Cart">

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
        <div class="Cart__product">
            <div class="Cart__productGrid Cart__productImg"></div>
            <div class="Cart__productGrid Cart__productTitle">
                {{$item->name}}
            </div>
            <div class="Cart__productGrid Cart__productPrice">
                {{$item->price}}
            </div>
            <div class="Cart__productGrid Cart__productQuantity">
                {{$item->quantity}}
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
            <div class="Cart__productGrid Cart__productDel">&times;</div>
        </div>
        @endforeach

    </div>
</div>
@endsection


@section('js')


@endsection
