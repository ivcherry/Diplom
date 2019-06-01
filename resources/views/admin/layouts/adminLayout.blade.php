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
    <link href="/css/style.css" rel="stylesheet">
    <!-- Styles -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
<div class="layout">
    <div class="sidebar">
        <div class="dropdown" style="margin: 20px">
            <span style="font-size: 14px; color: white;">Добро пожаловать &nbsp &nbsp;</span>
            <br>
            <span style="color: white; margin: 20px">{{Auth::user()->getFullName()}}</span>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt" style="color: white"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">{{ csrf_field() }}</form>
        </div>
        <hr>
        <h4>Главное меню</h4>
        <ul class="admin_menu">
            <li>
                <i class="fas fa-plus" style="margin-right: 10px"></i>
                <a href="/admin/categories">Категории</a>
            </li>
            <li>
                <i class="fas fa-plus" style="margin-right: 10px"></i>
                <a href="/admin/subCategories">Подкатегории</a>
            </li>
            <li>
                <i class="fas fa-plus" style="margin-right: 10px"></i>
                <a href="/admin/features">Характеристики</a>
            </li>
            <li>
                <i class="fas fa-plus" style="margin-right: 10px"></i>
                <a href="/admin/subCategories/features">Добавление характеристик к подкатегориям</a>
            </li>
            <hr>
            <li>
                <i class="fas fa-align-justify" style="margin-right: 10px"></i>
                <a href="/admin/products">Товары</a>
            </li>
            {{--<li>--}}
            {{--<i class="fas fa-folder" style="margin-right: 10px"></i>--}}
            {{--<a href="/admin/orders">Заказы</a>--}}
            {{--</li>--}}
            <li>
                <i class="fas fa-image" style="margin-right: 10px"></i>
                <a href="/admin/products/photos">Фотографии товаров</a>
            </li>
            <li>
                <i class="fas fa-book" style="margin-right: 10px"></i>
                <a href="/admin/products/features">Характеристики товаров</a>
            </li>
            <hr>
            <li>
                <i class="fas fa-users" style="margin-right: 10px"></i>
                <a href="/admin/user_data">Пользователи</a>
            </li>
            <li>
                <i class="fas fa-sticky-note" style="margin-right: 10px"></i>
                <a href="/admin/sales">Акции</a>
            </li>
            <li>
                <i class="fas fa-calendar-week" style="margin-right: 10px"></i>
                <a href="/admin/news">Новости</a>
            </li>
            <li>
                <i class="fas fa-history" style="margin-right: 10px"></i>
                <a href="/admin/companyHistory">История компании</a>
            </li>
            <hr>
            {{--<li>--}}
            {{--<i class="fas fa-address-card" style="margin-right: 10px"></i>--}}
            {{--<a href="/admin/contacts">Контакты</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<i class="fas fa-headset" style="margin-right: 10px"></i>--}}
            {{--<a href="/admin/technicalSupport">Тех.поддержка</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<i class="fas fa-wind" style="margin-right: 10px"></i>--}}
            {{--<a href="/admin/howToFindUs">Как нас найти</a>--}}
            {{--</li>--}}
        </ul>
    </div>
    <div class="content">
        @yield('content')
    </div>
</div>
<div class="footer">
    &copy;&nbsp;&nbsp; Все права защищены.
</div>
</div>

</div>
<div id="loader"><img src="/css/Default/loading-image.gif"/></div>
<!-- Scripts -->
<script src="/js/bootbox.min.js"></script>
@yield('scripts')
</body>
</html>
