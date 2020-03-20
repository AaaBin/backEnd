@extends('layouts/nav')



@section('content')



{{-- <section class="engine"><a href="https://mobirise.info/g">build a website for free</a></section> --}}
<section class="cid-qTkA127IK8 mbr-fullscreen mbr-parallax-background" id="header2-1">





    <div class="container align-center">
        <div class="row justify-content-md-center">
            <div class="mbr-white col-md-10">
                <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">
                    AaaBin Backend
                </h1>
                @if (session('status'))
                    <div class="text-center">
                        <h3 class="text-secondary p-3 rounded">
                            {{ session('status') }}
                        </h3>
                    </div>
                @endif
                @if (session('message'))
                    <div class="text-center">
                        <h3 class="text-secondary p-3 rounded">
                            {{ session('message') }}
                        </h3>
                    </div>
                @endif
                @if (session('hello'))
                    <div class="text-center">
                        <h3 class="text-secondary p-3 rounded">
                            {{ session('hello') }}
                        </h3>
                    </div>
                @endif

            </div>
        </div>
    </div>

</section>


@endsection

@section('js')
@endsection







{{--
<section class="mbr-gallery mbr-slider-carousel cid-rRF176nNHj" id="gallery1-3">



    <div class="container">
        <div>
            <!-- Filter -->
            <!-- Gallery -->
            <div class="mbr-gallery-row">
                <div class="mbr-gallery-layout-default">
                    <div>
                        <div class="">
                            <div class="mbr-gallery-item mbr-gallery-item--p1" data-video-url="false" data-tags="酷毙">
                                <div href="#lb-gallery1-3" data-slide-to="0" data-toggle="modal"><img
                                        src="assets/images/background1.webp" alt="" title=""><span
                                        class="icon-focus"></span></div>
                            </div>
                            <div class="mbr-gallery-item mbr-gallery-item--p1" data-video-url="false" data-tags="响应式">
                                <div href="#lb-gallery1-3" data-slide-to="1" data-toggle="modal"><img
                                        src="assets/images/background2.jpg" alt="" title=""><span
                                        class="icon-focus"></span></div>
                            </div>
                            <div class="mbr-gallery-item mbr-gallery-item--p1" data-video-url="false" data-tags="创意">
                                <div href="#lb-gallery1-3" data-slide-to="2" data-toggle="modal"><img
                                        src="assets/images/background3.jpg" alt="" title=""><span
                                        class="icon-focus"></span></div>
                            </div>
                            <div class="mbr-gallery-item mbr-gallery-item--p1" data-video-url="false" data-tags="动画">
                                <div href="#lb-gallery1-3" data-slide-to="3" data-toggle="modal"><img
                                        src="assets/images/background4.jpg" alt="" title=""><span
                                        class="icon-focus"></span></div>
                            </div>
                            <div class="mbr-gallery-item mbr-gallery-item--p1" data-video-url="false" data-tags="酷毙">
                                <div href="#lb-gallery1-3" data-slide-to="4" data-toggle="modal"><img
                                        src="assets/images/background5.jpg" alt="" title=""><span
                                        class="icon-focus"></span></div>
                            </div>
                            <div class="mbr-gallery-item mbr-gallery-item--p1" data-video-url="false" data-tags="酷毙">
                                <div href="#lb-gallery1-3" data-slide-to="5" data-toggle="modal"><img
                                        src="assets/images/background6.jpg" alt="" title=""><span
                                        class="icon-focus"></span></div>
                            </div>
                            <div class="mbr-gallery-item mbr-gallery-item--p1" data-video-url="false" data-tags="响应式">
                                <div href="#lb-gallery1-3" data-slide-to="6" data-toggle="modal"><img
                                        src="assets/images/background7.jpg" alt="" title=""><span
                                        class="icon-focus"></span></div>
                            </div>
                            <div class="mbr-gallery-item mbr-gallery-item--p1" data-video-url="false" data-tags="动画">
                                <div href="#lb-gallery1-3" data-slide-to="7" data-toggle="modal"><img
                                        src="assets/images/background8.jpg" alt="" title=""><span
                                        class="icon-focus"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Lightbox -->
            <div data-app-prevent-settings="" class="mbr-slider modal fade carousel slide" tabindex="-1"
                data-keyboard="true" data-interval="false" id="lb-gallery1-3">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="carousel-inner">
                                <div class="carousel-item active"><img src="assets/images/background1.jpg" alt=""
                                        title=""></div>
                                <div class="carousel-item"><img src="assets/images/background2.jpg" alt="" title="">
                                </div>
                                <div class="carousel-item"><img src="assets/images/background3.jpg" alt="" title="">
                                </div>
                                <div class="carousel-item"><img src="assets/images/background4.jpg" alt="" title="">
                                </div>
                                <div class="carousel-item"><img src="assets/images/background5.jpg" alt="" title="">
                                </div>
                                <div class="carousel-item"><img src="assets/images/background6.jpg" alt="" title="">
                                </div>
                                <div class="carousel-item"><img src="assets/images/background7.jpg" alt="" title="">
                                </div>
                                <div class="carousel-item"><img src="assets/images/background8.jpg" alt="" title="">
                                </div>
                            </div><a class="carousel-control carousel-control-prev" role="button" data-slide="prev"
                                href="#lb-gallery1-3"><span class="mbri-left mbr-iconfont"
                                    aria-hidden="true"></span><span class="sr-only">Previous</span></a><a
                                class="carousel-control carousel-control-next" role="button" data-slide="next"
                                href="#lb-gallery1-3"><span class="mbri-right mbr-iconfont"
                                    aria-hidden="true"></span><span class="sr-only">Next</span></a><a class="close"
                                href="#" role="button" data-dismiss="modal"><span class="sr-only">Close</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<section class="mbr-section article content11 cid-rRF18vYb9Z" id="content11-4">


    <div class="container">
        <div class="media-container-row">
            <div class="mbr-text counter-container col-12 col-md-8 mbr-fonts-style display-7">
                <ol>
                    <li><strong>lorem</strong> Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas
                        doloremque fugiat alias sed saepe ratione illum quia reiciendis a fuga, asperiores hic cumque
                        odit aut incidunt beatae dolorem quasi ut.<a href="">Try it now!</a></li>
                    <li><strong>lorem</strong> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sed ipsam
                        officia nam, distinctio in corrupti est necessitatibus! Nostrum dolorem voluptates asperiores?
                        <a href="">Try it now!</a></li>
                    <li><strong>lorem</strong> Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi saepe
                        eveniet dolor repellat voluptatum voluptatibus voluptate, omnis, inventore illo obcaecati rem
                        laborum dignissimos ipsum voluptas eos possimus laudantium officia accusamus totam impedit
                        deserunt.<a href="">Try it
                            now!</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="mbr-section article content14 cid-rRF19x19Q9" id="content14-5">



    <div class="container">
        <div class="media-container-row">
            <div class="row col-12 col-md-12">
                <div class="col-12 mbr-text mbr-fonts-style col-md-4 display-7">
                    <p class="p-3">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis at iste hic
                        voluptatem nesciunt eum eaque obcaecati! Adipisci nulla sint distinctio, repudiandae soluta modi
                        omnis vero officiis dolores, excepturi facilis temporibus ipsam hic magni obcaecati.</p>
                </div>
                <div class="col-12 mbr-text mbr-fonts-style display-7 col-md-4">
                    <p class="p-3">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis at iste hic
                        voluptatem nesciunt eum eaque obcaecati! Adipisci nulla sint distinctio, repudiandae soluta modi
                        omnis vero officiis dolores, excepturi facilis temporibus ipsam hic magni obcaecati.</p>
                </div>
                <div class="col-12 col-md-4 mbr-text mbr-fonts-style display-7">
                    <p class="p-3">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis at iste hic
                        voluptatem nesciunt eum eaque obcaecati! Adipisci nulla sint distinctio, repudiandae soluta modi
                        omnis vero officiis dolores, excepturi facilis temporibus ipsam hic magni obcaecati.</p>
                </div>
            </div>
        </div>
    </div>
</section> --}}
