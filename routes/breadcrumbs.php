<?php

//Главная
Breadcrumbs::register('home', function($breadcrumbs){
    $breadcrumbs->push('Главная', route("home"));
});

//История компании
Breadcrumbs::register('companyHistory', function ($breadcrumbs){
    $breadcrumbs->parent('home');
    $breadcrumbs->push('История компании', route("companyHistory"));
});

//Каталог
Breadcrumbs::register('catalog', function ($breadcrumbs){
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Каталог', route('catalog'));
});

//Категория
Breadcrumbs::register('category', function ($breadcrumbs, $data){
    $breadcrumbs->parent('catalog');
    $breadcrumbs->push($data->getName(), route('category',['categoryId' => $data->getId()] ));
});
//Подкатегория
Breadcrumbs::register('products', function ($breadcrumbs, $data){
    $breadcrumbs->parent('category', $data->getGenericType());
    $breadcrumbs->push($data->getName(), route('subCategory', $data->getId()));
});

//Корзина
Breadcrumbs::register('shoppingCart', function($breadcrumbs){
   $breadcrumbs->parent('home');
   $breadcrumbs->push('Корзина', route('shoppingCart'));
});

//Сравнение
Breadcrumbs::register('compare', function($breadcrumbs){
   $breadcrumbs->parent('home');
   $breadcrumbs->push('Сравнение товаров', route('compare'));
});

//Контакты
Breadcrumbs::register('contacts', function ($breadcrumbs){
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Контакты', route("contacts"));
});

//Тех.поддержка
Breadcrumbs::register('technicalSupport', function ($breadcrumbs){
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Тех.поддержка', route("technicalSupport"));
});

//Как нас найти
Breadcrumbs::register('howToFindUs', function ($breadcrumbs){
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Как нас найти', route("howToFindUs"));
});
//Оформление заказа
Breadcrumbs::register('order', function ($breadcrumbs){
    $breadcrumbs->parent('shoppingCart');
    $breadcrumbs->push('Оформление заказа', route("order"));
});

Breadcrumbs::register('thanksForPurchase', function ($breadcrumbs){
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Завершение заказа', route("thanksForPurchase"));
});
Breadcrumbs::register('equipment', function ($breadcrumbs){
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Комплектация', route("equipment"));
});
