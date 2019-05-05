@extends('client.layouts.clientLayout')
@section('breadcrumbs')
    {{Breadcrumbs::render('thanksForPurchase')}}
@endsection
@section('content')
    <div>
        <h3>
            Спасибо за покупку! В ближайшее время с вами свяжется менеджер для уточнения деталей заказа.
            <a href="/catalog">Перейти к каталогу товаров</a>
        </h3>
    </div>
@endsection
