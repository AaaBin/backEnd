@extends('layouts/nav')
@section('content')
<section class="engine"><a href="https://mobirise.info/x">css templates</a></section><section class="features3 cid-rRF3umTBWU" id="features3-7">
    <div class="container" style="padding:120px 0 0 0; min-height:100vh">
        <h2>NEWS</h2>
        <div class="media-container-row flex-wrap ">

            {{-- 有資料送進來後可以將資料運用在頁面內容中 --}}
            {{-- 用foreach將每一筆資料寫入樣板中，自動產生同類型的內容 --}}
            <div class="card-deck">
                @foreach ($news_data as $item)
                    <div class="card bg-white m-2" style="width: 18rem;">
                        <img src="/storage/{{$item->url}}" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">{{$item->title}}</h5>
                        <p class="card-text overflow-auto">{!!$item->content!!} Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                        <a href="/news/detail/{{$item->id}}" class="btn btn-primary ">More</a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
@endsection
