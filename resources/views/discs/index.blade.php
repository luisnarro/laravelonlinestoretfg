<!-- resources/views/discs/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        @if (count($discs) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    Últimos discos
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
                                        <div><img src="{{ url('/').$disc->img_path }}" alt="{{ $disc->name }}" height="50" width="50"></div>
                                    </td>

                                   

                                    <td>
                                        <div>{!! Html::linkAction('ArtistController@artistInfo', $disc->artist->first()->name, array($disc->artist->first()->id)) !!}</div>
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
                                        <!-- {!! Html::linkAction('UserController@add_to_cart', 'Añadir al carro', array($disc->id), array('class' => 'btn btn-primary btn-mini')) !!} -->
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
                    {{ $discspag->links() }}
                </div>
            </div>
            @if(Auth::guest())
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p>Para obtener recomendacioes personalizadas regístrate e inicia sesión en nuestro sitio </br>
                            Nuestro sistema de recomendación te mostrará discos basados en tus gustos en tu zona personal.
                        </p>
                    </div>
                </div>
            @endif
        @endif
    </div>  
@endsection