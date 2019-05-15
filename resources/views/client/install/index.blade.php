@extends('client.layouts.clientLayout')
@section('breadcrumbs')
@endsection
@section('content')
    <div class="order-form" style="font-size: 14px;">
        <form id="installForm" action="/thanksForOrdering" method="POST">
            {{ csrf_field() }}
            <h3>Установка ПО</h3>
            <div class="form-group">
                <span>ФИО</span>
                <div>
                    <input name="fullName" type='text' id="fullName" class="form-control form-provide"
                           style="width: 100%; height: inherit">
                </div>
            </div>
            <div class="form-group">
                <span>Ваш адрес</span>
                <div>
                    <input name="adress" type='text' id="adress" class="form-control form-provide"
                           style="width: 100%; height: inherit">
                </div>
            </div>
            <div class="form-group">
                <span>Ваш телефон</span>
                <div>
                    <input name="phoneNumber" type='text' id="phoneNumber" class="form-control form-provide"
                           style="width: 100%; height: inherit">
                </div>
            </div>
            <div class="form-group">
                <span>Ваш E-mail</span>
                <div>
                    <input name="eMail" type='text' id="eMail" class="form-control form-provide"
                           style="width: 100%; height: inherit">
                </div>
            </div>
            <div class="form-group form-provide">
                <span>Список требуемых ПО на установку</span>
                <div>
                  <select class="form-control" name="installingPO" size="1" style="width: 50%; margin-top: 10px">
                      <option selected disabled>Выбрать</option>
                      <option value="office">MS программы</option>
                      <option value="skype">Браузеры</option>
                      <option value="avast">Антивирусные программы</option>
                      <option value="ccleaner">Другие программы</option>
                  </select>
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-primary btn-md" type="submit">Заказать услугу</button>
            </div>

        </form>

    </div>


@endsection
@section('scripts')


@endsection
