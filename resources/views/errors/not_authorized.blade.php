@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Backend de la tienda</div>

                <div class="panel-body">
                    Esto es la trastienda, no hay nada interesante por aquí.</br>
                    <a class="btn btn-link" href="{{ url('/home') }}">Volver a la tienda online.</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection