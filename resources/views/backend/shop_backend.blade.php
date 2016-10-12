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

                    <form action="#" method="post">
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

                    <?php
                        if(isset($_POST['tag'])){
                            $url="http://ws.audioscrobbler.com/2.0/?method=tag.gettopalbums&tag=".$_POST['tag']."&limit=10&api_key=31b17cdc13c44d7b1f8d7bd80afa6b14";
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents

                            $data = curl_exec($ch); // execute curl request
                            curl_close($ch);

                            $xml = simplexml_load_string($data);
                            $albums = $xml->albums[0];

                            foreach ($albums as $attr => $valor){
                                ?>
                                    <a href=<?php echo ($valor->url); ?>><?php echo ($valor->name); ?></a></br>
                                    <img src=<?php echo ($valor->image[2]); ?> alt=<?php echo ($valor->name); ?>>
                                    </br>
                                <?php 
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection