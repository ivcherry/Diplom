@extends('client.layouts.clientLayout')

@section('content')
    {{--<div id="howToFindUsContent">--}}
    {{--</div>--}}

    <h1 style="margin: 20px 40%">Акции компании</h1>
    <div class="jumbotron" style="width: 80%; margin: 20px auto; height: 300px;">
        <h3>Apple</h3>
        <p>Скидки на техницу Apple</p>
        <hr>
        <p>В период с 20.05.19 по 30.05.19 на всю технику от компании Apple будут действовать скидки, заходи и
            проверь.</p>
        <div class="bottom-news" style="display: flex; justify-content: space-between">
            <a href="#" class="btn btn-primary btn-lg">Читать больше</a>
            <span>17.05.2019</span>
        </div>
    </div>

    <div class="jumbotron" style="width: 80%; margin: 20px auto; height: 300px;">
        <h3>Huawei</h3>
        <p>Скидки на техницу Huawei</p>
        <hr>
        <p>В период с 20.05.19 по 30.05.19 на всю технику от компании Huawei будут действовать скидки, заходи и
            проверь.</p>
        <div class="bottom-news" style="display: flex; justify-content: space-between">
            <a href="#" class="btn btn-primary btn-lg">Читать больше</a>
            <span>17.05.2019</span>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $.get('/howToFindUs/getContent', function (response) {
                $("#howToFindUsContent").html(response);
            });
        });
    </script>
@endsection
