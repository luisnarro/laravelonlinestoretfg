
@extends('backend.shop_backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Añadir Disco a la Base de Datos de la tienda</div>
                    <div class="panel-body">
                        Información de lo que se va a añadir.
                        <form action="{{ url('admin/albumsbytag') }}" method="GET">
                            <label>EAN:</label>
                            <input type="text" ></br>
                            <label>Nombre del album:</label>
                            <input type="text" name="nombreAlbum" value="{{ $albumData[0] }}"></br>
                            <label>Año:</label>
                            <input type="text" value="{{ $albumData[2] }}"></br>
                            <label>Nº de canciones:</label>
                            <input type="text" value="{{ $albumData[3] }}"></br>
                            <label>Duración total:</label>
                            <input type="text" value="{{ $albumData[4] }}"></br>
                            <label>Artista:</label>
                            <input type="text" value="{{ $albumData[5] }}"></br>
                            <label>Id Artista LastFM:</label>
                            <input type="text" value="{{ $albumData[7] }}"></br>
                            <label>Id Album LastFM:</label>
                            <input type="text" value="{{ $albumData[6] }}"></br>
                            <br><br>
                            <input type="submit" value="Añadir">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

