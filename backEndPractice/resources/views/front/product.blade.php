@extends('layouts/nav')


@section('css')
<style>
    a{
        color: white;
    }
</style>

@endsection


@section('content')
<section class="mbr-gallery mbr-slider-carousel cid-rS3hYJJSXz" id="gallery2-3">



    <div class="container " style="padding-top:120px">

        <h2>PRODUCT</h2>

        <div>
            <!-- Filter -->
            <div class="mbr-gallery-filter container gallery-filter-active">
                <ul buttons="0">
                    <li class="mbr-gallery-filter-all"><a class="btn btn-sm btn-info-outline active display-4"
                            href="">All</a>
                    </li>
                </ul>
            </div><!-- Gallery -->
            <div class="mbr-gallery-row" style="min-height:70vh">
                <div class="mbr-gallery-layout-default">
                    <div>
                        <div>

                            {{-- 在foreach中帶入$key，代表陣列的鍵值 --}}
                            @foreach ($product_data as $key => $item)
                            <div class="mbr-gallery-item mbr-gallery-item--p2 " data-video-url="false"
                                data-tags="{{$item->category}}">
                                <a href="/product_detail/{{$item->id}}" data-slide-to="{{$key}}" data-toggle="modal" class="bg-secondary rounded d-flex flex-column align-items-center shadow-lg">
                                    <img class="p-1" src="/storage/{{$item->url}}" alt="" title="">
                                    <span  class="p-1 bg-transparent text-center">{{$item->name}}</span>
                                    <span  class="bg-transparent text-center">{{$item->price}}$</span>
                                </a>

                            </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>



        </div>
    </div>

</section>


<section class="engine"><a href="https://mobirise.info/d">free site maker</a></section>

@endsection



<!-- Lightbox -->
<div data-app-prevent-settings="" class="mbr-slider modal fade carousel slide" tabindex="-1"
data-keyboard="true" data-interval="false" id="lb-gallery2-3">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <div class="carousel-inner">
                {{-- 需要預設有一個div的class有active，才能順利使用lightbox --}}
                @foreach ($product_data as $key=>$item)
                    @if ($key == 0)
                        <div id="light{{$key}}" class="carousel-item active">
                            <img src="/storage/{{$item->url}}" alt="" title="">
                        </div>
                    @else
                        <div id="light{{$key}}" class="carousel-item">
                            <img src="/storage/{{$item->url}}" alt="" title="">
                        </div>
                    @endif
                @endforeach

            </div>


            <a class="carousel-control carousel-control-prev" role="button" data-slide="prev"
                href="#lb-gallery2-3">
                <span class="mbri-left mbr-iconfont" aria-hidden="true"></span>
                <span class="sr-only">Previous</span></a><a
                class="carousel-control carousel-control-next" role="button" data-slide="next"
                href="#lb-gallery2-3"><span class="mbri-right mbr-iconfont"
                    aria-hidden="true"></span><span class="sr-only">Next</span></a><a class="close"
                href="#" role="button" data-dismiss="modal"><span class="sr-only">Close</span></a>
        </div>
    </div>
</div>
</div>
