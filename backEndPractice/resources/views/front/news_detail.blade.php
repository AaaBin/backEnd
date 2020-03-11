@extends('layouts/nav')


@section('css')
    <style>
        #inner_card{

        }
    </style>

@endsection


@section('content')
<section class="engine"><a href="https://mobirise.info/x">css templates</a></section>
<section class="features3 cid-rRF3umTBWU" id="features3-7">
    <div class="container text-light" style="padding:100px 0 0 0; min-height:100vh">


            {{-- 在前端頁面中也可以使用到關聯的function --}}
            {{-- {{$item->news_imgs}} --}}
            {{-- 再用foreach將各筆資料抓出 --}}

            <h2 class="row p-3 text-body rounded">
                title:{{$item->title}}
            </h2>
            <div class="row bg-secondary border rounded py-2">
                <div class="p-1 pr-3">
                    <img class="rounded shadow-lg" width="400px" src="/storage/{{$item->url}}" alt="">
                </div>
                <div class="col-6 pt-2 ">
                    <p class=" p-3">
                        content: <br>
                        {!!$item->content!!}，Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque amet dolore neque inventore. Consectetur autem quis quo culpa deleniti ipsa, nam debitis animi quidem. Adipisci iure ea reprehenderit saepe officia?
                    </p>
                </div>
            </div>
            <div class="card-deck">
                @foreach ($item->news_imgs as $key=>$news_img)
                <div class="m-1  bg-secondary p-1 rounded border">
                    <p class="">
                        sub img{{$key}}
                    </p>
                    <img class="rounded shadow-lg" width="200px" src="/storage/{{$news_img->img_url}}" alt="">
                </div>
                @endforeach
            </div>




    </div>
</section>
@endsection
