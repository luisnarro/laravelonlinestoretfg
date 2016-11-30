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
                    <div style="font-size: 28px;color: #555555;">7€</div>
                    <a href="#" class="btn btn-primary btn-lg text-white">Añadir al carro</a>
                    <h4>Cantidad</h4>
                    <form>
                        <div class="form-group">
                            <input type="number" class="form-control" min="1" value="1" style="width:70px;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                            <div class="tab-pane active" id="tab_default_1">
                                <ul>
                                    <li> White dwarf extraplanetary</li>
                                    <li> Worldlets, white dwarf</li>
                                    <li> Cambrian explosion, hydrogen</li>
                                    <li> Euclid Sea of Tranquility</li>
                                </ul>
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

        </div>
        <!--recently view item end-->
    </div>
@endsection