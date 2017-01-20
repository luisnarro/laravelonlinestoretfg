@extends('layouts.app')

@section('content')

    <div class="container">
        <!--item view start-->
        <div class="row">
            <div class="mart10">
                <!--product view-->
                <div class="col-md-4">
                    <div class="row">
                        <div class="product_wrapper">
                            <div style="height:258px;width:390px;"><img src="{{url('/').$disc->img_path}} " class="img-responsive" style="position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;"></div>
                        </div>
                    </div>
              
                </div>
                <!--individual product description-->
                <div class="col-md-8">
                    <h2 class="text-primary">{{ $disc->name }} </h2>                    
                    <h4>{{$disc->artist->first()->name}}</h4>
                    <p>
                    {{ $disc->artist->first()->bio }}
                    </p>
                    <div style="font-size: 28px;color: #555555;">7€</div>
                    <a href="{{ url('/user/addtocart/'.$disc->id) }}" class="btn btn-primary btn-lg text-white"><i class="fa fa-shopping-cart"></i> Añadir al carro</a>
                    <!--
                    <h4>Cantidad</h4>
                    <form>
                        <div class="form-group">
                            <input type="number" class="form-control" min="1" value="1" style="width:70px;">
                        </div>
                    </form>
                    -->
                </div>
            </div>
        </div>
        </br>
        <!--item view end-->
        <!--item desciption start-->
        <div class="row">
            <div class="col-sm-12">
                <!-- Tabbable-Panel Start -->
                <div class="tabbable-panel">
                    <!-- Tabbablw-line Start -->
                    <div class="tabbable-line">
                        <!-- Nav Nav-tabs Start -->
                        <ul class="nav nav-tabs ">
                            <li class="active">
                                <a href="#tab_default_1" data-toggle="tab"> Lista de canciones </a>
                            </li>
                            
                            <li>
                                <a href="#tab_default_2" data-toggle="tab"> Escúchalo en LastFm </a>
                            </li>
                            
                        </ul>
                        
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_default_1"></br>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <ul>
                                            @foreach ($disc->tracks as $track)
                                                <li>
                                                    <a href="{{ $track->url }}" target="_blank">{{$track->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_default_2">
                                <div class="row">
                                    <div class="col-sm-4">
                                        
                                    </div>
                                    <div class="col-sm-8">
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    <!-- Tabbable_panel End -->
                </div>
            </div>
        </div>
        <!--item desciption end-->
        <!--recently view item-->
        <div class="row">
            @if(Auth::guest())
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p>Para obtener recomendacioes personalizadas regístrate e inicia sesión en nuestro sitio </br>
                            Nuestro sistema de recomendación te mostrará discos basados en tus gustos en tu zona personal.
                        </p>
                    </div>
                </div>
            @else

                    <h2 class="text-primary"> Recomendaciones para tí</h2>
                    <div style="border-bottom:2px solid #418bca;"></div>
                    <div>
                        <figure>
                            <img src="" alt="product image">
                            <figcaption>
                                <h4 class="text-white">Nombre del disco</h4>
                                <h5 class="text-white">Nombre del artista</h5>
                            </figcaption>
                        </figure>
                    </div>
                
            @endif
        </div>
        <!--recently view item end-->
    </div>

    <script type="text/javascript">
        // Llamada al controller que corresponda para añadir el disco a la lista de recomendación del usuario.
        var req = new XMLHttpRequest();
        req.open("GET", "user/vieweddisc/{{$disc->id}}");
        req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        req.onreadystatechange=function(){
            if (req.readyState==4){
                if (req.status==200){

                }else{

                }
            }else{
                
            }
        };

        //req.send();
    </script>
@endsection