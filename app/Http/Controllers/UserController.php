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

    public function __construct(User $user)
    {
        $this->middleware('auth');

        $this->user = $user;
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
        Cart::instance('shoppingcart');
        $disc = Disc::find($disc_id);
        $cartItem = Cart::add($disc);
        Cart::store(strval(Auth::user()->id));

        $carro = Cart::content();

        //$parameters = ['disco' => $disc, 'usuario' => $this->user];
        //return redirect()->back()->with($parameters);

        return view('discs.prueba', [
            'carro' => $carro,
            'id' => Auth::user()->id,
            'strid' => strval($this->user->id),
            'cantidad' => Cart::get($cartItem->rowId)->qty,
        ]);
        
    }


}