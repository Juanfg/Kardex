@extends('layouts.auth')

@section('title', 'Registrar Usuario')

@section('content')
    <div class="form-header">
        <div class="app-brand"><span class="highlight">Kardex</span> Registro</div>
    </div>
    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </span>
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre" aria-describedby="basic-addon1" required autofocus>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </span>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail" aria-describedby="basic-addon1" required autofocus>
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
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon2">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </span>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Password" aria-describedby="basic-addon2" required>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success btn-submit">
                Registrar Usuario
            </button>
        </div>
    </form>

@endsection
