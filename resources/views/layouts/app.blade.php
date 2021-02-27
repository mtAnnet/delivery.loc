<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Delivery Food</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset("js/like.js") }}" type="text/javascript" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap&subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<body>
<div class="header"><div class="container">
        <div class="header-content">
            <div class="header-left">
                <a href="{{ url('/') }}"><img src="{{asset('img/logo.svg')}}" alt="Logo" class="logo img-svg"></a>
                @if(isset($cities))
                    <form class="search-form search-border" action="{{route('index.filter.city')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <select class="input input-search" name="city" id="input-search-city">
                            @foreach($cities as $city)
                                <option  value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                        <button id="search-btn-header" type="submit" value="" class="search-btn "><i class="fa fa-search"></i></button>
                    </form>
                @endif
            </div>
            <div class="buttons">
                @guest
                <a href="{{ route('login') }}" class="button button-primary" style="margin-right: 10px;">
                    <img src="{{asset('img/user.svg')}}" alt="user" class="button-icon">
                    <span class="button-text">Войти</span></a>
                @else
                        <ul class="topmenu">
                            <li>
                                <a class="submenu-link">
                                    <img src="{{asset('img/user.svg')}}" alt="user" class="button-icon">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="submenu">
                                    <li><a href="{{route('user.orders')}}">Мои заказы</a></li>
                                    <li><a class="text_copy_link">{{Auth::user()->promocode['promocode']}}</a></li>
                                    <li><a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">Выйти</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </li>
                        </ul>
                @endguest
                <a href="{{route('basket.index')}}" class="button">
                    <img src="{{asset('img/basket2.svg')}}" alt="shopping cart" class="button-icon">
                    <span>Корзина</span>
                    <span style="margin-left: 5px;"></span>
                </a>
            </div>
        </div>
    </div>
</div>
   <main class="main">
       <div class="copy_link_mess">Промокод скопирован</div>
       @yield('main')
   </main>
   <footer class="footer">
       <div class="container">
           <div class="footer-block">
               <a href="{{ url('/') }}"><img src="{{asset('img/logo.svg')}}" alt="Logo" class="logo footer-logo"></a>
               <nav class="footer-nav">
                   <a href="#" class="footer-link">Ресторанам </a>
                   <a href="#" class="footer-link">Курьерам</a>
                   <a href="#" class="footer-link">Пресс-центр</a>
                   <a href="#" class="footer-link">Контакты</a>
               </nav>
               <div class="social-links">
                   <a href="#" class="social-link"><img src="{{asset('img/insta.svg')}}" alt="instagram"></a>
                   <a href="#" class="social-link"><img src="{{asset('img/face.svg')}}" alt="facebook"></a>
                   <a href="#" class="social-link"><img src="{{asset('img/gmail.svg')}}" alt="facebook"></a>
               </div>
           </div>
       </div>
   </footer>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    jQuery(document).ready(function($){
        $('.text_copy_link').click(function() {
            var $text_copy = $(this);
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($text_copy.text()).select();
            document.execCommand("copy");
            $temp.remove();
            $('.copy_link_mess').fadeIn(400);
            setTimeout(function(){$('.copy_link_mess').fadeOut(400);},2000);
        });
    });
</script>
