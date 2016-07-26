<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;
use Auth;
use Esception;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Funciones para manejar el login de Twitter.
     */

    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterCallback()
    {
        try {
            $user = Socialite::driver('twitter')->user();
            
            $create['name'] = $user->name;
            $create['email'] = $user->email;
            
            
            $userModel = new User;
            //$createdUser = $userModel->addNew($create);
            //Auth::loginUsingId($createdUser->id);
            //return redirect()->route('home');*/

            return view('welcome', [
                'user' => $user,
            ]);

            
        } catch (Exception $e) {
            //return redirect('auth/twitter');
        }
       
    }


    /**
     * Funciones para manejar el login de Spotify.
     */

    public function redirectToSpotify()
    {
        //return Socialite::with('spotify')->redirect();

        return Socialite::driver('spotify')->redirect();
    }

    public function handleSpotifyCallback(Request $request)
    {
        try {
            $state = $request->get('state');
            $request->session()->put('state',$state);
            $user = Socialite::driver('spotify')->user();
            
            //$create['name'] = $user->name;
            //$create['email'] = $user->email;
            
            
            //$userModel = new User;
            //$createdUser = $userModel->addNew($create);
            //Auth::loginUsingId($createdUser->id);
            //return redirect()->route('home');*/

            return view('welcome', [
                'user' => $user,
            ]);

            
        } catch (Exception $e) {
            //return redirect('auth/twitter');
        }
       
    }
}
