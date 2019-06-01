@extends('client.layouts.clientLayout')
@section('breadcrumbs')
    <div>
        {{Breadcrumbs::render('contacts')}}
    </div>
@endsection
@section('content')
    <div id="contactsContent">
        <p style="font-size: 18px">Интернет - магазин "NICE SHOP" расположен в г. Москва по улице Никольская, 54 А. на
            втором этаже.</p>
        <div style="display: flex; justify-content: space-between; width: 80%; flex-wrap: wrap" class="block">
            <div class="blocks">
                <h3>Наши телефоны:</h3>
                <p style="font-size: 16px"><strong style="font-size: 18px">Консультант по товарам:</strong> <a
                            href="tel:+ 7(499)-123-15-15" style="color: #000;">&nbsp;&nbsp; + 7 (499) - 123 - 15 -
                        15</a></p>
                <p style="font-size: 16px"><strong style="font-size: 18px">Консультант по доставкам:</strong><a
                            href="tel:+ 7(499)-024-48-48" style="color: #000;"> &nbsp;&nbsp; + 7 (499) - 024 - 48 -
                        48</a></p>
            </div>
            <div class="blocks">
                <h3>Наши почты:</h3>
                <p style="font-size: 16px"><strong style="font-size: 18px">Консультант по товарам:</strong> &nbsp;&nbsp;<a
                            href="mailto: fvuaetn@gmail.ru" style="color: #000">fvuaetn@gmail.ru</a></p>
                <p style="font-size: 16px"><strong style="font-size: 18px">Консультант по доставкам:</strong> &nbsp;&nbsp;<a
                            href="mailto:tjdspfht@yandex.ru" style="color: #000">tjdspfht@yandex.ru</a></p>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $.get('/contacts/getContent', function (response) {
                $("#contactsContent").html(response);
            });
        });
    </script>
@endsection
