@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Backend de la tienda</div>
                <div class="panel-body">
                    Esta es la pantalla de administración de la tienda online. Únicamente usuarios administradores o dependientes de
                    la tienda deberían tener acceso a esta página.
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Añadir discos a la BBDD desde LAST FM</div>
                <div class="panel-body">
                    <h3>Top Albums por Tag:</h3>

                    <form action="{{ url('admin/albumsbytag') }}" method="GET">
                        <label>Tag:</label>
                        <select name="tag">
                            <option value="disco">Disco</option>
                            <option value="rock">Rock</option>
                            <option value="electronic">Electronic</option>
                            <option value="indie">Indie</option>
                        </select>
                        <br><br>
                        <input type="submit">
                    </form>
                    </br>

                    @if (!empty($data))
                        <table id="cart" class="table table-striped disc-table">
                        <thead>
                            <tr>
                                <th>Album</th>
                                <th>Artista</th>
                                <th>Portada</th>
                                <th>Información</th>
                                <th>Añadir album</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach ($data as $album)
                            <tr>
                                <td data-th="table-text">
                                    <div>{{ $album->name }}</div>
                                </td>
                                <td>
                                    <div>{{ $album->artist->name }}</div>
                                </td>  
                                <td>
                                    <div><img src="{{ $album->image[2] }}" alt="{{ $album->name }}" height="50" width="50"></div>
                                </td>
                                <td>
                                    <div><a href="{{ $album->url }}" target="_blank">Más Info</a></div>
                                </td>
                                <td>
                                    <a href="{{ action('LastfmscrappingController@addalbum', ['albumname' => $album->name, 'artistname' => $album->artist->name]) }}" class="btn btn-success btn-block">Añadir a la tienda</a>
                                </td>
                            </tr>
                        @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection