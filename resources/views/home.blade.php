@extends('layouts.sidebar')

@section('content')
    <div class="card">
        <div class="card-header">
            Estudiantes
        </div>
        <div class="scroll card-body no-padding">
            <!-- para ver el search se pone datatable en la class de table (ESTO QUITA LA FUNCIONALIDAD DEL SCROLL)  -->
            <table class="table table-striped primary" cellspacing="0">
            </table>
        </div>
    </div>
@endsection
