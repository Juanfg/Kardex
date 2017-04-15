@extends('layouts.sidebar')

@section('content')

    <div class="card">
        <div class="card-header">
            Aqu&iacute; podr&aacute;s seleccionar los programas acad&eacute;micos que te ser&aacute;n visibles
        </div>
        <div class="card-body">
            {{ Form::open(['method' => 'post', 'route' => 'program.select']) }}
                {!! Form::label('Visibles'); !!}
                @foreach ($programs_user as $program)
                    <div class="form-group">
                        <input name="{{ $program->name }}" type="checkbox" value="{{ $program->id }}" checked>
                        {{ $program->name }}
                    </div>
                @endforeach
                <hr>
                {!! Form::label('No visibles') !!}
                @foreach ($programs_not_user as $program)
                    <div class="form-group">
                        <input name="{{ $program->name }}" type="checkbox" value="{{ $program->id }}">
                        {{ $program->name }}
                    </div>
                @endforeach
                <div class="form-group">
                    <p></p>
                    {!! Form::submit('Guardar', ['class' => 'btn primery btn-success']); !!}
                </div>
            {{ Form::close() }}
        </div>
    </div>
    
@endsection