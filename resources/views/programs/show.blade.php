@extends('layouts.sidebar')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ $program->name }}
        </div>
        <div class="scroll card-body no-padding">
            <table class="table table-striped primary" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Estudiante</th>
                        @foreach ($courses as $course)
                            <th>{{ $course->code }} / {{ $course->name }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            @foreach ($student->courses as $course)
                                @if (!$course->pivot->grade)
                                    @if ($course->pivot->approved)
                                        <td>A</td>
                                    @elseif ($course->pivot->currently_studying)
                                        <td>CU</td>
                                    @else
                                        <td>N/A</td>
                                    @endif
                                @else
                                    <td>{{ $course->pivot->grade }}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-body">
            {!! Form::open( [ 'method' => 'GET', 'route' => ['program.excel', $program->id]]) !!}
                <button class="btn btn-success"><i class="fa fa-file-excel-o"></i> Exportar a Excel</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
