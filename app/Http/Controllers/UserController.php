<?php

namespace App\Http\Controllers;


use App\User;
use App\Disc;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\DiscRepository;
use Cart;

class UserController extends Controller
{

    protected $user;
    protected $usercart;

    public function __construct(User $user)
    {
        $this->middleware('auth');

        $this->user = $user;

        // Se recupera o crea la instancia del carro de compra para el usuario
        Cart::restore(strval(Auth::user()->id));
        $this->usercart = Cart::instance('shoppingcart'.strval(Auth::user()->id))->content();
        Cart::store(strval(Auth::user()->id));

    }

    public function index(Request $request)
    {
        /* Cart::instance('newInstance');
        Cart::add('293ad', 'Product 1', 1, 9.99);
        Cart::store('12345678'); */
        $prueba = Cart::content();
        return view('home', [
            
        ]);
    }

    public function add_to_cart(Request $request, $disc_id)
    {
        $disc = Disc::find($disc_id);

        //Cart::restore(strval(Auth::user()->id));
        //$carro = Cart::instance('shoppingcart')->content();
        
            //Cart::instance('shoppingcart');
            Cart::restore(strval(Auth::user()->id));
            $this->usercart = Cart::instance('shoppingcart'.strval(Auth::user()->id));
            $cartItem = $this->usercart->add($disc);
            Cart::store(strval(Auth::user()->id));
        
        //$carro = Cart::content();

        //$parameters = ['disco' => $disc, 'usuario' => $this->user];
        //return redirect()->back()->with($parameters);

        //return view('discs.prueba', [
            //'carro' => $this->carro,
            //'id' => Auth::user()->id,
        //]);


        return redirect()->back();
        
    }

    public function shoppingcart(Request $request)
    {
        return view('shoppingcart.shoppingcart', [
            'usercart' => $this->usercart,
            //'id' => Auth::user()->id,
        ]);
    }

    public function checkoutsp(Request $request)
    {
        return view('shoppingcart.checkoutsp', [
            //'carro' => $this->carro,
            //'id' => Auth::user()->id,
        ]);
    }

    public function update_usercart(Request $request, $rowId, $qty)
    {
        Cart::restore(strval(Auth::user()->id));
        Cart::update($rowId, $qty);
        Cart::store(strval(Auth::user()->id));
        return redirect()->back();
    }

    public function remove_usercart_item(Request $request, $rowId)
    {
        Cart::restore(strval(Auth::user()->id));
        Cart::remove($rowId);
        Cart::store(strval(Auth::user()->id));
        return redirect()->back();
    }


}