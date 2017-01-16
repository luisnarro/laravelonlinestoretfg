<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['condiciones', 'avisolegal', 'gastosenvio', 'contacto']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function condiciones()
    {
        return view('legal/servicio');
    }

    public function avisolegal()
    {
        return view('legal/privacidad');
    }

    public function gastosenvio()
    {
        return view('legal/gastosenvio');
    }

    public function contacto()
    {
        return view('legal/contacto');
    }
}
