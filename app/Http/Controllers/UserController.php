<?php

namespace App\Http\Controllers;


use App\User;
use App\Disc;
use App\RecomendationIn;
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

        // Se realiza la petición al sistema de recomendación.
        

    }

    public function index(Request $request)
    {
        /* Cart::instance('newInstance');
        Cart::add('293ad', 'Product 1', 1, 9.99);
        Cart::store('12345678'); */

        //RecomendationIn::request_rec_system(Auth::user()->id);

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

            //Insertar el disco añadido en el carro en la tabla "recomendations_in"
            RecomendationIn::set_user_discs(strval(Auth::user()->id), $disc_id);

        
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
            'usercart' => $this->usercart,
            //'id' => Auth::user()->id,
        ]);
    }

    public function update_usercart(Request $request, $rowId)
    {
        if ($request->has('qty'))
        {
            Cart::restore(strval(Auth::user()->id));
            Cart::update($rowId, $request->input('qty'));
            Cart::store(strval(Auth::user()->id));
            return redirect()->back();
        }
        
    }

    public function remove_usercart_item(Request $request, $rowId)
    {
        Cart::restore(strval(Auth::user()->id));
        Cart::remove($rowId);
        Cart::store(strval(Auth::user()->id));
        return redirect()->back();
    }

    public function validate_checkout(Request $request)
    {
        
    }

    public function admin(Request $request)
    {
        // Si el usuario es administrador.    
        return view('backend/shop_backend', [
            
        ]);
    }

    public function new_visited_disc(Request $request, $disc_id)
    {
        RecomendationIn::set_user_discs(strval(Auth::user()->id), $disc_id);

        return "ok";
    }


}