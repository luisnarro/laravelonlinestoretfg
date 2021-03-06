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
                        Discos que contienen el estilo de música: {{ $style_name }}
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">

                        <table class="table table-striped disc-table">

                            <thead>
                                <th>Discos</th>
                                <th>&nbsp;</th>
                                <!--<th>Artista</th>-->
                                <th>Artista</th>
                                <!--<th>Grupo</th>-->
                                <th>Estilos</th>
                                <th>&nbsp;</th>
                            </thead>

                            <tbody>
                                @foreach ($discs as $disc)
                                    <tr>
                                        <td class="table-text">
                                            <div>{!! Html::linkAction('DiscController@discs_details', $disc->name, array($disc->id)) !!}</div>
                                        </td>

                                        <td>
                                            <div><img src="{{ url('/').$disc->img_path }}" alt="{{ $disc->name }}" height="50" width="50"></div>
                                        </td>

                                  

                                        <td>
                                            <div>{!! Html::linkAction('ArtistController@artistInfo', $disc->artist->first()->name, array($disc->artist->first()->id)) !!} </div>
                                        </td>


                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Estilos
                                                <span class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                    @foreach ($disc->styles as $style)
                                                        <li role="presentation">
                                                            {!! Html::linkAction('StyleController@styleDiscs', $style->name, array($style->id.'/discs')) !!}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <form action="{{ url('/user/addtocart/'.$disc->id) }}" method="GET">
                                                <button type="submit" id="add-disc-{{ $disc->id }}" class="btn btn-primary btn-mini">
                                                    <i class="fa fa-shopping-cart"></i> Añadir
                                                </button>
                                            </form>
                                            <!--{!! Html::linkAction('UserController@add_to_cart', 'Añadir al carro', array($disc->id), array('class' => 'btn btn-primary btn-mini')) !!}-->
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </div>
                        </table>
                        {{ $discspag->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>  
@endsection