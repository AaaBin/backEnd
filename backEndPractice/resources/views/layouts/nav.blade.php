<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <!-- Site made with Mobirise Website Builder v4.12.1, / -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v4.12.1, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    {{-- <link rel="shortcut icon" href="assets/images/logo2.png" type="image/x-icon"> --}}
    <link rel="icon" href="{{asset('accessible-icon-brands.svg')}}">
    <meta name="description" content="">

    <title>backend test</title>
    <link rel="stylesheet" href="{{asset('assets/web/assets/mobirise-icons/mobirise-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap-reboot.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/socicon/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dropdown/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/tether/tether.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/theme/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/gallery/style.css')}}">
    <link rel="preload" as="style" href="{{asset('assets/mobirise/css/mbr-additional.css')}}">
    <link rel="stylesheet" href="{{asset('assets/mobirise/css/mbr-additional.css')}}" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    {!! ReCaptcha::htmlScriptTagJsApi() !!}

    {{-- csrf token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        * {
            font-family: 'Noto Sans TC', sans-serif !important;
        }

        .dropdown-menu.show {
            display: block !important;
        }

        .cid-qTkzRZLJNu .dropdown .dropdown-menu {
            background-color: rgb(51, 51, 51);
        }

        .cid-qTkzRZLJNu .dropdown-item {
            color: rgb(233, 233, 233) !important;
        }

        .cid-qTkzRZLJNu .dropdown-item:hover {
            color: red !important;
        }
    </style>
    @yield('css')


</head>

<body>
    <section class="menu cid-qTkzRZLJNu" once="menu" id="menu1-0">



        <nav
            class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm ">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="menu-logo">
                <div class="navbar-brand">
                    <span class="navbar-caption-wrap">
                        <a class="navbar-caption text-white display-5" href="/">
                            AaaBin
                        </a>
                        <a class="navbar-caption text-white display-4" href="/home"
                            style='font-family:微軟正黑體; font-weight:200'>
                            後台管理
                        </a>
                        <a class="navbar-caption text-white display-4" href="/product_detail"
                            style='font-family:微軟正黑體; font-weight:200'>
                            TEST
                        </a>
                    </span>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                    <li class="nav-item">
                        <a class="nav-link link text-white display-4" href="/news">
                            NEWS
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link text-white display-4" href="/product">
                            PRODUCT
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link text-white display-4" href="/contacts">
                            CONTACT
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link text-white display-4" href="/shoppingcart">
                            <?php

                        if (Auth::user()) {
                            $user_id = Auth::user()->id;
                            $cart_items_qty = \Cart::session($user_id)->getContent()->count();
                        } else {
                            $cart_items_qty = 0;
                        };
                        ?>
                            SHOPPINGCART({{$cart_items_qty}})
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-3">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <div class="dropdown p-1">
                        <a class="btn text-light dropdown-toggle m-0" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="/account">
                                My Account
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    @endguest
                </ul>
            </div>

        </nav>
    </section>
    @yield('content')

    <section class="cid-qTkAaeaxX5" id="footer1-2">





        <div class="container">
            <div class="media-container-row content text-white">
            </div>
            <div class="footer-lower">
                <div class="media-container-row">
                    <div class="col-sm-12">
                        <hr>
                    </div>
                </div>
                <div class="media-container-row mbr-white">
                    <div class="col-sm-6 copyright">
                        <p class="mbr-text mbr-fonts-style display-7">
                            © Copyright AaaBin - All Rights Reserved
                        </p>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="{{asset('assets/web/assets/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/popper/popper.min.js')}}"></script>
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/smoothscroll/smooth-scroll.js')}}"></script>
    <script src="{{asset('assets/dropdown/js/nav-dropdown.js')}}"></script>
    <script src="{{asset('assets/dropdown/js/navbar-dropdown.js')}}"></script>
    <script src="{{asset('assets/touchswipe/jquery.touch-swipe.min.js')}}"></script>
    <script src="{{asset('assets/tether/tether.min.js')}}"></script>
    <script src="{{asset('assets/masonry/masonry.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/bootstrapcarouselswipe/bootstrap-carousel-swipe.js')}}"></script>
    <script src="{{asset('assets/vimeoplayer/jquery.mb.vimeo_player.js')}}"></script>
    <script src="{{asset('assets/parallax/jarallax.min.js')}}"></script>
    <script src="{{asset('assets/theme/js/script.js')}}"></script>
    <script src="{{asset('assets/gallery/player.min.js')}}"></script>
    <script src="{{asset('assets/gallery/script.js')}}"></script>
    <script src="{{asset('assets/slidervideo/script.js')}}"></script>

    @yield('js')
</body>

</html>
