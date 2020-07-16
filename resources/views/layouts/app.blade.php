<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/de5e5e06b9.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    <title>@yield('title','HOME') | Share with friends</title>
    <meta name="description" content="@yield('description','友達にクイズをシェアすることができます。')">
    <meta name="keywords" content="@yield('keywords','クイズ,友達,シェア')">

    @if(app('env') === 'production')
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        <link rel="shortcut icon" href="{{ secure_asset('images/favicon3.ico') }}" type="image/vnd.microsoft.icon">
    @else
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('images/favicon3.ico') }}" type="image/vnd.microsoft.icon">
@endif

<!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Sawarabi+Mincho&display=swap" rel="stylesheet">
</head>
<body>
@if (session('status'))
    <div class="p-alert" role="alert">
        {{ session('status') }}
    </div>
@endif
<header class="l-header">
    <div class="l-header__container" id="js-container">
        <h1 class="l-header__title"><a class="l-header__titleLink" href="/">Share with friends</a></h1>
        <nav id="js-nav-menu" class="l-header__nav">
            <ul class="l-header__navList">
                @guest
                    <li class="l-header__navItem"><a href="{{route('register')}}" class="l-header__navLink">新規登録</a></li>
                    <li class="l-header__navItem"><a href="{{route('login')}}" class="l-header__navLink">ログイン</a></li>
                @else
                    <li class="l-header__navItem"><a href="{{ route('home') }}" class="l-header__navLink">マイページ</a></li>
                    <li class="l-header__navItem"><a href="{{ route('logout') }}"
                                                     class="l-header__navLink"
                                                     onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">ログアウト</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </ul>
        </nav>
    </div>
    <div id="js-toggle-menu" class="l-header__hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>
</header>
<main class="l-main">
    <div class="l-container">
        @yield('content')
    </div>
</main>
<footer class="l-footer">
    <div class="l-container l-footer__container">
        Copyright © Share with friends. All Rights Reserved.
    </div>
</footer>

@if(app('env') == 'production')
    <script src="{{ secure_asset('js/app.js') }}" type="text/javascript"></script>
@else
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endif

<script>
    window.axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
    };
    let nav = document.getElementById('js-nav-menu');
    let hamburger = document.getElementById('js-toggle-menu');
    let container = document.getElementById('js-container');
    hamburger.addEventListener('click',function(){
        if(nav.classList.contains('js-active')){
            nav.classList.remove('js-active');
            hamburger.classList.remove('js-active');
        }else{
            nav.classList.add('js-active');
            hamburger.classList.add('js-active');
        }

    });
</script>
</body>
</html>
