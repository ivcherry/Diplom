<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title></title>

    <link href="/css/kendo.common.min.css" rel="stylesheet">
    <link href="/css/kendo.default.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/kendo.all.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/client.css') }}" rel="stylesheet">

</head>
<body>

      <div class="navbar">

          <ul id="ddmenu" >

            <p id="title">КОМПУТЕР текник</p>

            <li><a href="/home">Главная</a></li>
            <li><a href="#">Новости и акции</a>
             <ul>
                <li><a href="#">Новости</a></li>
                <li><a href="#">Акции</a></li>
              </ul>
            </li>
            <li><a href="#">Товары</a>
              <ul>
                @foreach($genericTypes as $genericType)
                    <li class>
                        <a tabindex="-1" href="#">{{ $genericType->getName() }}</a>
                        <ul>
                            @foreach($genericType->getTypes() as $type)
                                <li><a href="/products?subCategory={{$type->getId()}}">{{$type->getName()}}</a></li>
                            @endforeach
                        </ul>
                    </li>

                @endforeach
              </ul>
            </li>
              <li><a href="/companyHistory">История компании</a></li>
            <li><a href="#">Связь</a>
              <ul>
                <li><a href="/contacts">Контакты</a></li>
                <li><a href="/technicalSupport">Тех.поддержка</a></li>
                <li><a href="/howToFindUs">Как нас найти</a></li>
              </ul>
            </li>
            <li><a href="#">Доп.услуги</a>
              <ul>
                <li><a href="/install">Установка ПО</a></li>
                <li><a href="/tuning">Настройка техники</a></li>
              </ul>
            </li>
            <li>
                <a href="/equipment">Комплектация</a>
            </li>
            <li class="shoppingCart">
                <a href="/shoppingCart">
                    <span><img src="/css/Default/cart.png" width="50" height="50"/></span>
                        @if(Session::has('cart'))
                            <span class="cart-product-count">{{Session::get('cart')->getProductsCount()}}</span>
                        @else
                            <span class="cart-product-count">0</span>
                        @endif
                </a>
            </li>
            <li class="compare">
                <a href="/compare">
                    <span><img src="/css/Default/compare.png" width="40" height="40"/></span>
                        @if(Session::has('compareProducts'))
                            <span class="compare-product-count">{{ Session::get('compareProducts')->getComparedCount() }}</span>
                        @else
                            <span class="compare-product-count">0</span>
                        @endif
                </a>
            </li>
            <div class="login">
              @auth

              <a href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                  выход
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST"
                    style="display: none;">
                  {{ csrf_field() }}
              </form>

              @else
                  <a href="{{ route('login') }}">вход</a>
                  <a href="{{ route('register') }}">регистрация</a>
              @endauth
            </div>
          </ul>
      </div>
      <div class="breadcrumbs">
        @yield('breadcrumbs')
      </div>
      <div class="content">
        @yield('content')
    </div>

    <div class="footer">
        Собственность "гениальных" разработчиков современности. 2k17
    </div>

<!-- Scripts -->
@yield('scripts')
<script src="/js/client/menu.js"></script>
</body>
</html>
