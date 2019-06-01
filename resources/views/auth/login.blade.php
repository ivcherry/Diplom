@extends('client.layouts.clientLayout')

@section('content')
    <div class="container">
        <div class="row auth">
            <div class="panel panel-default panel-auth" style="margin: 50px 0; padding-left: 50px;">
                <div class="panel-heading" style="margin: 20px 0;"><h4>Вход</h4></div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">E-Mail</label>

                            <div>
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" required autofocus style="width: 90%">
                                @if ($errors->has('email'))
                                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Пароль</label>
                            <div>
                                <input id="password" type="password" class="form-control" name="password" required
                                       style="width: 90%">
                                @if ($errors->has('password'))
                                    <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        Запомнить
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary btn-sm" style="width: 100px">Вход</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
