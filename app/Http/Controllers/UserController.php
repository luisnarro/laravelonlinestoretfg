<?php

namespace App\Http\Controllers;


use App\User;
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
        Cart::instance('newInstance');
        Cart::add('293ad', 'Product 1', 1, 9.99);
        Cart::store('12345678');
        $prueba = Cart::content();
        return view('home', [
            'prueba' => $prueba,
        ]);
    }


}