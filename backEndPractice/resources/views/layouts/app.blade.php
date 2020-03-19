<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="icon" href="{{asset('accessible-icon-brands.svg')}}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {!! ReCaptcha::htmlScriptTagJsApi() !!}
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- 給css用的區塊 --}}
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <?php
                $permission = "not ok";
                if (Auth::user()) {
                    $user = Auth::user();
                    if ($user->role == "admin") {
                        $permission = "ok";
                    };
                };
                ?>
                @if ($permission == 'ok')
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                畫面
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/" >
                                   landing page
                                </a>
                                <a class="dropdown-item" href="/news" >
                                    news
                                </a>
                                <a class="dropdown-item" href="/product" >
                                    product
                                </a>
                                <a class="dropdown-item" href="/contacts" >
                                    contacts
                                </a>
                                <a class="dropdown-item" href="/shoppingcart" >
                                    shoppingcart
                                </a>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="/home/news">最新消息</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                產品
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/home/product" >
                                   產品列表
                                </a>

                                <a class="dropdown-item" href="/home/productCategory" >
                                    產品類別
                                </a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/home/contact">聯絡訊息</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/home/order_list">訂單列表</a>
                        </li>

                    </ul>

                    <!-- Right Side Of Navbar -->

                </div>

                @endif
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>

            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- 給js用的區塊 --}}
    @yield('js')
</body>
</html>
