@extends('client.layouts.clientLayout')

@section('content')
    {{--<div id="technicalSupportContent">--}}
    {{--</div>--}}

    <h1 style="margin: 20px 40%">Новости компании</h1>
    <div class="jumbotron" style="width: 80%; margin: 20px auto; height: 300px;">
        <h3>Открытие магазина</h3>
        <p>Крутые новости, не пожалеешь!</p>
        <hr>
        <p>Рады сообщить Вам, что наш магазин начал свою деятельность спустя долгое время, в честь этого у нас проходят
            акции и скидки на разный товар.</p>
        <div class="bottom-news" style="display: flex; justify-content: space-between">
            <a href="#" class="btn btn-primary btn-lg">Читать больше</a>
            <span>10.10.2019</span>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $.get('/technicalSupport/getContent', function (response) {
                $("#technicalSupportContent").html(response);
            });
        });
    </script>
@endsection
