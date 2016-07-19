<!-- resources/views/discs/prueba.blade.php -->

@extends('layouts.app')

@section('content')
{!!Html::style('css/custom.css')!!}
    <div class="container">
        @if (count($usercart) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    Carro de compra
                </div>

                <div class="panel-body">
                    
                   <table id="cart" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th style="width:50%">Disco</th>
                                <th style="width:10%">Precio</th>
                                <th style="width:8%">Cantidad</th>
                                <th style="width:22%" class="text-center">Subtotal</th>
                                <th style="width:10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usercart as $item)
                                <tr>
                                    <form action="{{ action('UserController@update_usercart', ['rowId' => $item->rowId]) }}">
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-sm-2 hidden-xs"><img src="http://placehold.it/100x100" alt="..." class="img-responsive"/></div>
                                            <div class="col-sm-10">
                                                <h4 class="nomargin">{{ $item->name }}</h4>
                                                <!-- <p>Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet.</p> -->
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price">{{ $item->price }}€</td>
                                    <td data-th="Quantity">
                                        <input type="number" class="form-control text-center" name="qty" value="{{ $item->qty }}">
                                    </td>
                                    <td data-th="Subtotal" class="text-center">{{ $item->price }}</td>
                                    <td class="actions" data-th="">
                                        {{ Form::submit('Actualizar', array('class' => 'btn btn-info btn-sm')) }}
                                        <!-- <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button> -->
                                        <!-- {!! Html::linkAction('UserController@update_usercart', 'Actualizar', array($item->rowId, 1), array('class' => 'btn btn-info btn-sm')) !!}-->
                                        <!-- <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button> -->
                                        {!! Html::linkAction('UserController@remove_usercart_item', 'Quitar', array($item->rowId), array('class' => 'btn btn-danger btn-sm')) !!}
                                    </td>
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="visible-xs">
                                <td class="text-center"><strong>Total 1.99</strong></td>
                            </tr>
                            <tr>
                                <td><a href="{{ url('discs') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continuar comprando</a></td>
                                <td colspan="2" class="hidden-xs"></td>
                                <td class="hidden-xs text-center"><strong>Total {{ Cart::subtotal() }}</strong></td>
                                <td><a href="{{ url('user/checkoutsp') }}" class="btn btn-success btn-block">Realizar pedido <i class="fa fa-angle-right"></i></a></td>
                            </tr>
                        </tfoot>
                    </table>  
             
                </div>
                @foreach ($usercart as $item)
                    {{ var_dump($item) }}
                @endforeach
                {{ var_dump($usercart) }}
            </div>
        @endif
    </div>  
@endsection