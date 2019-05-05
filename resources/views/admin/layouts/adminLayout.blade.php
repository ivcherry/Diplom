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
</head>
<body>
<div class="header">

    <div class="dropdown">
        <a href="#" class="dropdown-toggle btn-default" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
            {{Auth::user()->getFullName()}} <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
</div>
    <div class="layout">
        <div class="sidebar">
            <h4>Администрирование</h4>
            <ul class="admin_menu">
                <li><a href="/admin/categories">Категории</a></li>
                <li><a href="/admin/subCategories">Подкатегории</a></li>
                <li><a href="/admin/features">Характеристики</a></li>
                <li><a href="/admin/subCategories/features">Добавление характеристик к подкатегориям</a></li>
                <li><a href="/admin/compatibilities">Совместимость характеристик</a></li>
                <hr>
                <li><a href="/admin/products">Товары</a></li>
                <li><a href="/admin/orders">Заказы</a></li>
                <li><a href="/admin/products/photos">Фотографии товаров</a></li>
                <li><a href="/admin/products/features">Характеристики товаров</a></li>
                <hr>
                <li><a href="/admin/user_data">Пользователи</a></li>
                <li><a href="/admin/sales">Акции</a></li>
                <li><a href="/admin/news">Новости</a></li>
                <hr>
                <li><a href="/admin/companyHistory">История компании</a></li>
                <li><a href="/admin/contacts">Контакты</a></li>
                <li><a href="/admin/technicalSupport">Тех.поддержка</a></li>
                <li><a href="/admin/howToFindUs">Как нас найти</a></li>
            </ul>
        </div>
        <div class="content">
            @yield('content')
        </div>
        </div>
        <div class="footer">
            Собственность "гениальных" разработчиков современности. 2017
        </div>
    </div>

</div>
<div id="loader"><img src="/css/Default/loading-image.gif"/></div>
<!-- Scripts -->
<script src="/js/bootbox.min.js"></script>
@yield('scripts')
</body>
</html>
