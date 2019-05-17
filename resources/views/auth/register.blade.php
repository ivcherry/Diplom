@extends('client.layouts.clientLayout')

@section('content')
    <div class="container">
        <div class="row auth">
            <div class="col-md-8 col-md-offset-2 panel-auth">
                <div class="panel panel-default" style="margin: 10px 0; padding-left: 50px;">
                    <div class="panel-heading" style="margin: 20px 0;"><h4>Регистрация</h4></div>

                    <div class="panel-body reg">
                        <form class="form-horizontal" method="POST" action="/auth/register">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('fullName') ? ' has-error' : '' }}">
                                <label for="fullName" class="col-md-4 control-label">Имя</label>
                                <div class="col-md-6">
                                    <input id="fullName" type="text" class="form-control" name="fullName" value="{{ old('fullName') }}" required autofocus>
                                    @if ($errors->has('fullName'))
                                        <span class="help-block"><strong>{{ $errors->first('fullName') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Пароль</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Подтвердение пароля</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btn-md">Зарегистрироваться</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
