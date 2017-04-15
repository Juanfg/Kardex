@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="form-header">
        <div class="app-brand"><span class="highlight">Kardex</span> Login</div>
    </div>
    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </span>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" aria-describedby="basic-addon1" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon2">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </span>
                <input id="password" type="password" class="form-control" name="password" placeholder="Password" aria-describedby="basic-addon2" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success btn-submit">
                Login
            </button>
        </div>
    </form>

    <div class="form-line">
        <div class="title">OR</div>
    </div>
    <div class="form-footer">
        <a class="btn btn-info" href="{{ route('register') }}">Registrate</a>
    </div>
@endsection
