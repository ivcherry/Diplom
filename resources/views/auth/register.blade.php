@extends('client.layouts.clientLayout')

@section('content')
    <div class="container">
        <div class="row auth">
            <div class="panel panel-default panel-auth">
                <div class="panel-heading" style="margin: 20px 0;"><h4>Регистрация</h4></div>

                <div class="panel-body reg">
                    <form class="form-horizontal" method="POST" action="/auth/register">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('fullName') ? ' has-error' : '' }}">
                            <label for="fullName">Имя</label>
                            <div>
                                <input id="fullName" type="text" class="form-control form-provide" name="fullName"
                                       value="{{ old('fullName') }}" required autofocus>
                                @if ($errors->has('fullName'))
                                    <span class="help-block"><strong>{{ $errors->first('fullName') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">E-Mail</label>
                            <div>
                                <input id="email" type="email" class="form-control form-provide" name="email"
                                       value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Пароль</label>
                            <div>
                                <input id="password" type="password" class="form-control form-provide" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Подтвердение пароля</label>
                            <div>
                                <input id="password-confirm" type="password" class="form-control form-provide" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary btn-md">Зарегистрироваться</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
