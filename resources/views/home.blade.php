@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    ¡Te has autenticado!. Esta es tu zona personal en la tienda, aquí podrás gestionar tus compras y tu lista de deseos.
                </div>
            </div>
        </div>
    </div>
</div>
    @if(Auth::guest())
                    
    @else
        @include('layouts.recomendaciones')
    @endif
@endsection
