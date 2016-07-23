@extends('layouts.app')

@section('content')
{!!Html::style('css/checkout.css')!!}

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            Carro de compra
        </div>

        <div class="panel-body">


            <!-- <div class="row cart-head">
                <div class="container">
                <div class="row">
                    <p></p>
                </div>
                <div class="row">
                    <div style="display: table; margin: auto;">
                        <span class="step step_complete"> <a href="#" class="check-bc">Cart</a> <span class="step_line step_complete"> </span> <span class="step_line backline"> </span> </span>
                        <span class="step step_complete"> <a href="#" class="check-bc">Checkout</a> <span class="step_line "> </span> <span class="step_line step_complete"> </span> </span>
                        <span class="step_thankyou check-bc step_complete">Thank you</span>
                    </div>
                </div>
                <div class="row">
                    <p></p>
                </div>
                </div>
            </div> -->   
            <div class="row cart-body">
                <form class="form-horizontal" method="post" action="">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                    <!--REVIEW ORDER-->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Resumen de pedido <div class="pull-right"><small><a class="afix-1" href="{{ url('user/shoppingcart') }}">Editar carro</a></small></div>
                        </div>
                        <div class="panel-body">
                            @foreach ($usercart as $item)
                                <div class="form-group">
                                    <div class="col-sm-3 col-xs-3">
                                        <img class="img-responsive" src="//c1.staticflickr.com/1/466/19681864394_c332ae87df_t.jpg" />
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                        <div class="col-xs-12">{{ $item->name }}</div>
                                        <div class="col-xs-12"><small>Cantidad:<span>1</span></small></div>
                                    </div>
                                    <div class="col-sm-3 col-xs-3 text-right">
                                        <h6><span>€</span>{{ $item->price }}</h6>
                                    </div>
                                </div>
                                <div class="form-group"><hr /></div>
                            @endforeach
 
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Subtotal</strong>
                                    <div class="pull-right"><span>$</span><span>{{ Cart::total() }}}</span></div>
                                </div>
                                <div class="col-xs-12">
                                    <small>Gastos de envío</small>
                                    <div class="pull-right"><span>-</span></div>
                                </div>
                            </div>
                            <div class="form-group"><hr /></div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Total</strong>
                                    <div class="pull-right"><span>$</span><span>{{ Cart::total() }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--REVIEW ORDER END-->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-info">
                        <div class="panel-heading">Dirección</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <h4>Dirección de envío</h4>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>País:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="country" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-xs-12">
                                    <strong>Nombre:</strong>
                                    <input type="text" name="first_name" class="form-control" value="" />
                                </div>
                                <div class="span1"></div>
                                <div class="col-md-6 col-xs-12">
                                    <strong>Apellidos:</strong>
                                    <input type="text" name="last_name" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Dirección:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="address" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Provincia:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="state" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Localidad:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="city" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Código Postal:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="zip_code" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Número de teléfono:</strong></div>
                                <div class="col-md-12"><input type="text" name="phone_number" class="form-control" value="" /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Dirección de correo electrónico:</strong></div>
                                <div class="col-md-12"><input type="text" name="email_address" class="form-control" value="" /></div>
                            </div>
                        </div>
                    </div>
                    <!--SHIPPING METHOD END-->
                    <!--CREDIT CART PAYMENT-->
                    <div class="panel panel-info">
                        <div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Pago Seguro </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12"><strong>Tipo de Tarjeta:</strong></div>
                                <div class="col-md-12">
                                    <select id="CreditCardType" name="CreditCardType" class="form-control">
                                        <option value="5">Visa</option>
                                        <option value="6">MasterCard</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Número de tarjeta:</strong></div>
                                <div class="col-md-12"><input type="text" class="form-control" name="car_number" value="" /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Código CVV:</strong></div>
                                <div class="col-md-12"><input type="text" class="form-control" name="car_code" value="" /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <strong>Fecha de caducidad</strong>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="">
                                        <option value="">Mes</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="">
                                        <option value="">Año</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <span>Pago seguro utilizando tu tarjeta de crédito.</span>
                                </div>
                                <div class="col-md-12">
                                    <ul class="cards">
                                        <li class="visa hand">Visa</li>
                                        <li class="mastercard hand">MasterCard</li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button type="submit" class="btn btn-primary btn-submit-fix">Confirmar pedido</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--CREDIT CART PAYMENT END-->
                </div>
                
                </form>
            </div>
            <div class="row cart-footer">
        
            </div>






               

        </div>
    </div>
</div>  
@endsection