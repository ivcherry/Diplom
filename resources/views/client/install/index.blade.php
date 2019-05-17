@extends('client.layouts.clientLayout')
@section('breadcrumbs')
@endsection
@section('content')
    <div class="order-form" style="font-size: 14px;">
        <form id="installForm" action="/thanksForOrdering" method="POST">
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
                <span>Список требуемых ПО на установку</span>
                <div>
                  <select name="installingPO" size="1"  >
                      <option value="office">MS Office</option>
                      <option value="skype">Skype</option>
                      <option value="chrome">Chrome</option>
                      <option value="ccleaner">CCleaner</option>
                      <option value="avast">Avast Antivirus</option>
                  </select>
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-done" type="submit">Заказать услугу</button>
            </div>

        </form>

    </div>


@endsection
@section('scripts')


@endsection
