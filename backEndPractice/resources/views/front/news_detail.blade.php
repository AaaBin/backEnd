@extends('layouts/nav')
@section('content')
<section class="engine"><a href="https://mobirise.info/x">css templates</a></section>
<section class="features3 cid-rRF3umTBWU" id="features3-7">
    <div class="container" style="padding:100px 0 0 0; min-height:100vh">
        <div class="container">

            {{-- 在前端頁面中也可以使用到關聯的function --}}
            {{-- {{$item->news_imgs}} --}}
            {{-- 再用foreach將各筆資料抓出 --}}

            {{$item2}}

            <div class="row">
                <div class="">
                    main img
                    <img width="400px" src="/storage/{{$item->url}}" alt="">
                </div>
                <div class="col-3 pt-5">
                    <p>
                        {{$item->content}}
                    </p>
                </div>
            </div>
            <div class="row">
                @foreach ($item->news_imgs as $key=>$news_img)
                <div>
                    sub img{{$key}}
                    <img width="200px" src="/storage/{{$news_img->img_url}}" alt="">
                </div>
                @endforeach
            </div>





        </div>
    </div>
</section>
@endsection
