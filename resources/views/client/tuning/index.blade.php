@extends('client.layouts.clientLayout')
@section('breadcrumbs')
@endsection
@section('content')
    <div class="order-form" style="font-size: 14px;">
        <form id="installForm" action="/thanksForOrdering"  method="POST">
            {{ csrf_field() }}
            <h3>Настройка техники</h3>
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
                <span>Укажите, то нуждается в ремонте</span>
                <div>
                  <select class="form-control" name="installingPO" size="1" style="width: 50%;">
                      <option selected disabled>Выбрать</option>
                      <option value="1">Комплектующие ПК</option>
                      <option value="3">Windows</option>
                      <option value="3">Другие проблемы</option>
                  </select>
                </div>
            </div>

            <div class="form-group">
                <span>Описание проблемы</span>
                <div>
                    {{--<input name="summary" type='text' id="summary" class="form-control"--}}
                           {{--style="width: 100%; height: 100px">--}}
                    <textarea name="summary" id="summary" cols="30" rows="5" class="form-control" placeholder="Укажите  возникжие у Вас проблемы"></textarea>
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-primary btn-md" type="submit" id="installBtn">Заказать услугу</button>
            </div>

        </form>

    </div>


@endsection
@section('scripts')
@endsection
