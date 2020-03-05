@extends('layouts/nav')
@section('content')
<section class="engine"><a href="https://mobirise.info/x">css templates</a></section><section class="features3 cid-rRF3umTBWU" id="features3-7">
    <div class="container" style="padding:300px 0 0 0; min-height:100vh">
        <div class="media-container-row">

            {{-- 有資料送進來後可以將資料運用在頁面內容中 --}}
            {{-- 用foreach將每一筆資料寫入樣板中，自動產生同類型的內容 --}}
            @foreach ($news_data as $item)
                <div class="card p-3 col-12 col-md-6 col-lg-4">
                    <div class="card-wrapper">
                        <div class="card-img">
                            {{-- php語法 --}}
                            <img src="/storage/{{$item->url}}" alt="news_img">
                        </div>
                        <div class="card-box">
                            <h4 class="card-title mbr-fonts-style display-7">
                                {{$item->title}}
                            </h4>
                            <p class="mbr-text mbr-fonts-style display-7">
                                {{$item->content}}
                            </p>
                        </div>
                        <div class="mbr-section-btn text-center">
                            <a href="/news/detail/{{$item->id}}" class="btn btn-primary btn-sm">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach





        </div>
    </div>
</section>
@endsection
