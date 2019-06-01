@extends('client.layouts.clientLayout')
@section('breadcrumbs')
@endsection
@section('content')
    <div class="order-form" style="font-size: 14px;">
        <h3>Установка ПО</h3>
        <form id="installForm" action="/thanksForOrdering" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <span>ФИО</span>
                <div>
                    <input name="fullName" type='text' id="fullName" class="form-control form-fields"
                           style="width: 100%; height: inherit">
                </div>
            </div>
            <div class="form-group">
                <span>Ваш адрес</span>
                <div>
                    <input name="adress" type='text' id="adress" class="form-control form-fields"
                           style="width: 100%; height: inherit">
                </div>
            </div>
            <div class="form-group">
                <span>Ваш телефон</span>
                <div>
                    <input name="phoneNumber" type='text' id="phoneNumber" class="form-control form-fields"
                           style="width: 100%; height: inherit">
                </div>
            </div>
            <div class="form-group">
                <span>Ваш E-mail</span>
                <div>
                    <input name="eMail" type='text' id="eMail" class="form-control form-fields"
                           style="width: 100%; height: inherit">
                </div>
            </div>
            <div class="form-group">
                <span>Список требуемых ПО на установку</span>
                <div>
                    <select name="installingPO" class="form-control form-fields" size="1">
                        <option disabled selected>Выбрать</option>
                        <option value="office">Программы Microsoft</option>
                        <option value="skype">Антивирусные программы</option>
                        <option value="chrome">Другие программы</option>
                    </select>
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-success" type="submit">Заказать услугу</button>
            </div>
        </form>

    </div>


@endsection
@section('scripts')


@endsection
