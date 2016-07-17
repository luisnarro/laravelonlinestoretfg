<!-- resources/views/discs/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Últimos discos
                    </div>

                    <div class="panel-body">
                        {{ var_dump($carro) }}
                        {{ var_dump($id) }}                      
                    </div>
                </div>
        </div>
    </div>  
@endsection