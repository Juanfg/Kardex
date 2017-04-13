@extends('layouts.sidebar')

@section('content')

    @if (session('message'))
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('message') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Agregar un PDF nuevo
        </div>
        <div class="card-body">
            {{ Form::open(['method' => 'post', 'route' => ['pdf.store'], 'files' => 'true']) }}
                <div class="form-group">
                    {!! Form::label('PDF:'); !!}
                    {!! Form::file('pdf') !!}
                </div>
                <div class="form-group">
                    <p></p>
                    {!! Form::submit('Agregar', ['class' => 'btn primery btn-success']); !!}
                </div>
            {{ Form::close() }}
        </div>
    </div>
    
@endsection