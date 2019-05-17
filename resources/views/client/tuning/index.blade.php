@extends('client.layouts.clientLayout')
@section('breadcrumbs')
@endsection
@section('content')
    <div class="order-form" style="font-size: 14px;">
        <form id="installForm" action="/thanksForOrdering"  method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <span>ФИО</span>
                <div>
                    <input name="fullName" type='text' id="fullName" class="form-control"
                           style="width: 100%; height: inherit">
                </div>
            </div>
            <div class="form-group">
                <span>Ваш адрес</span>
                <div>
                    <input name="adress" type='text' id="adress" class="form-control"
                           style="width: 100%; height: inherit">
                </div>
            </div>
            <div class="form-group">
                <span>Ваш телефон</span>
                <div>
                    <input name="phoneNumber" type='text' id="phoneNumber" class="form-control"
                           style="width: 100%; height: inherit">
                </div>
            </div>
            <div class="form-group">
                <span>Ваш E-mail</span>
                <div>
                    <input name="eMail" type='text' id="eMail" class="form-control"
                           style="width: 100%; height: inherit">
                </div>
            </div>
            <div class="form-group">
                <span>Техника, которую необходимо починить:</span>
                <div>
                  <select name="installingPO" size="1">
                      <option value="1">Монитор</option>
                      <option value="2">Колонки</option>
                      <option value="3">omae wa mou shindeiru</option>
                  </select>
                </div>
            </div>

            <div class="form-group">
                <span>Описание проблемы</span>
                <div>
                    <input name="summary" type='text' id="summary" class="form-control"
                           style="width: 100%; height: inherit">
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-done" type="submit" id="installBtn">Заказать услугу</button>
            </div>

        </form>

    </div>


@endsection
@section('scripts')
@endsection
