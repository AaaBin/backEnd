@extends('layouts/nav')

@section('css')

    <style>
        .shopping_cart_container{
            padding: 120px  0;
        }

        .product_info_area{
            background-color: lightgray;
        }
        .info_section_title{
            font-size: 20px;
            line-height: 24px;
            font-weight: 400;
            color: #757575;
            margin-top: 30px;
            margin-bottom: 20px;
        }
        .top_info_title{
            font-size: 40px;
            font-weight: 400;
            line-height: 48px;
            color: #000;
        }
        .top_info_detail{
            font-size: 20px;
            line-height: 24px;
            color: #757575;
        }
        .top_info_price{
            color: #ff6700;
            font-weight: 400;
        }

        .bonus{
            display: inline-block;
            line-height: 17px;
            font-size: 12px;
            color: #757575;
            font-weight: 400;
            vertical-align: middle;
        }


        .option{
            text-align: center;
            cursor: pointer;
            border: 1px solid orange;
            transition: opacity,border .2s linear;
            background-color: white
        }
        .option.active{
            color: #424242;
            border:1px solid orangered;
        }

        .bottom_info span{
            text-align: left;
            font-style: normal;
            text-overflow: ellipsis;
            margin-right: 12px;
            font-size: 16px;
            color: #757575;
        }
        .quantity_input{
            text-align: center;
            display: inline-flex;
            border: 0;
            flex-shrink: 0;
            flex-grow: 1;
            color: #757575;
            font-size: 20px;
            line-height: 36px;
            height: 36px;
            width: 64px;
            padding: 0;
            outline: none;
        }
        .plus_minus_btn{
            flex-grow: 0;
            flex-shrink: 0;
            border: 0;
            background-color: #fff;
            user-select: none;
            width: 36px;
            height: 36px;
            padding: 0;
            box-sizing: border-box;
            position: relative;
            color: #424242;
        }
    </style>

@endsection

@section('content')

    <div  class="shopping_cart_container container">
        <h2>Product Info</h2>
        <div class="row">
            <div class="col-6">


            </div>


            <div class="product_info_area col-6 px-3 py-5">
                <div class="top_info">
                    <div class="top_info_title">
                        小米9T
                    </div>
                    <div class="top_info_detail d-flex">
                        <div class="capacity_info mr-3">
                            64GB
                        </div>
                        <div class="color_info">
                            RED
                        </div>
                    </div>
                    <div class="top_info_price">
                        NT$8,999
                    </div>
                </div>
                <div class="bonus">
                    雙倍該商品可享受雙倍積分
                </div>
                <div class="capacity d-flex flex-wrap ">
                    <div class="info_section_title col-12">容量</div>
                    <div class="option col-3 m-1 p-1 active" data-capcity="64GB">64GB</div>
                    <div class="option col-3 m-1 p-1" data-capcity="128GB">128GB</div>
                </div>
                <div class="color_option_area d-flex flex-wrap ">
                    <div class="info_section_title col-12">顏色</div>
                    <div class="option col-3 m-1 p-1 active" data-color="RED">RED</div>
                    <div class="option col-3 m-1 p-1" data-color="BLUE">BLUE</div>
                    <div class="option col-3 m-1 p-1" data-color="GREEN">GREEN</div>
                    <div class="option col-3 m-1 p-1" data-color="PURPLE">PURPLE</div>
                </div>
                <div class="quantity">
                    <div class="info_section_title col-12">數量</div>
                    <button class="plus_minus_btn minus">-</button>
                    <input type="number" value="1" disabled class="quantity_input">
                    <button class="plus_minus_btn plus">+</button>
                </div>
                <div class="bottom_info ">
                    <span>
                        小米9T
                    </span>
                    <span class="capacity_info">
                        64GB
                    </span>
                    <span class="color_info">
                        RED
                    </span>
                    <span>
                        NT$8,999
                    </span>
                </div>
                <input class="capcity_input" value="64GB">
                <input class="color_input" value="RED" >
                <button class="submit_btn">Submit</button>
            </div>
        </div>
    </div>



@endsection


@section('js')
    <script>
        // capacity按鈕
        $('.capacity .option').click(function (){
            $('.capacity .option').removeClass('active');
            $(this).addClass('active');

            let capacity_value = $(this).attr('data-capcity');
            $('.capcity_input').val(capacity_value);



        })

        //color按鈕
        $('.color_option_area .option').click(function (){
            $('.color_option_area .option').removeClass('active');
            $(this).addClass('active');

            let color_value = $(this).attr('data-color');
            $('.color_input').val(color_value);

        })


        //加減按鈕
        $('.plus').click(function () {
		    if ($(this).prev().val() < 5) {
    	        $(this).prev().val(+$(this).prev().val() + 1);
		}
        });
        $('.minus').click(function () {
            if ($(this).next().val() > 1) {
                if ($(this).next().val() > 1)
                    $(this).next().val(+$(this).next().val() - 1);
                }
        });





    </script>
@endsection
