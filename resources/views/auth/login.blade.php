@extends('app')

@section('header')
    <div class="mdl-layout-spacer"></div>
    <button class="mdl-button HeaderButton" onclick="location.href='/register'">
        <span class="mdl-layout-title ">Register</span>
    </button>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="mdl-card mdl-shadow--2dp" style="margin: auto;padding: 16;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <label class="mdl-textfield__label">E-Mail Address</label>
                                <input type="email" class="mdl-textfield__input" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <label class="mdl-textfield__label">Password</label>
                                <input type="password" class="mdl-textfield__input" name="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div >
                                <div class="checkbox" >
                                    <label for="checkbox" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                                        <input type="checkbox" id="checkbox" name="remember"  class="mdl-checkbox__input">
                                        <span class="mdl-checkbox__label">Remember Me</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                                    <i class="fa fa-btn fa-sign-in"></i>Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
