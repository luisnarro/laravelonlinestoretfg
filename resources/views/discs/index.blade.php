<!-- resources/views/discs/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <!--<div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Disc
            </div>

            <div class="panel-body">

                @include('common.errors')

                <form action="{{ url('disc') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="disc-name" class="col-sm-3 control-label">Disc</label>

                        <div class="col-sm-6">
                            <input type="text" name="name" id="disc-name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-plus"></i> Add Disc
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div> -->

            @if (count($discs) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Últimos discos
                    </div>

                    <div class="panel-body">

                        <table class="table table-striped disc-table">

                            <thead>
                                <th>Disco</th>
                                <th>&nbsp;</th>
                                <th>Artista</th>
                                <th>Grupo</th>
                                <th>Estilos</th>
                            </thead>

                            <tbody>
                                @foreach ($discs as $disc)
                                    <tr>
                                        <td class="table-text">
                                            <div>{{ $disc->name }}</div>
                                        </td>

                                        <!--<td>
                                            <form action="{{ url('disc/'.$disc->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-disc-{{ $disc->id }}" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form> 
                                            $prueba->first()->name
                                        </td>-->

                                        <td>
                                            <div><img src="{{ $disc->img_path }}" alt="{{ $disc->name }}" height="50" width="50"></div>
                                        </td>

                                        <td>
                                            <div>{!! Html::linkAction('ArtistController@artistInfo', $disc->artists->first()->name, array($disc->artists->first()->id)) !!}</div>
                                        </td>

                                        <td>
                                            <div>
                                                {!! Html::linkAction('GroupController@groupInfo', $disc->groups->first()->name, array($disc->groups->first()->id)) !!}
                                            </div>
                                        </td>
                                        <td>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>  
@endsection