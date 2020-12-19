<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use App\UserModels\UserData;

use Socialite;
use Auth;
use Exception;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);
    }




    public function redirectToGoogle() 
    {
        return Socialite::driver('google')->stateless()->redirect();
    }
    
    public function handleGoogleCallback() 
    {
        
        try {
            
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('google_id', $user->id)->first();


            if ($finduser) 
            {
                 Auth::login($finduser);
                 return redirect()->route('home');
            } else {
                $newUser = User::create(['name' => $user->name, 
                                         'email' => $user->email, 
                                         'google_id' => $user->id]);
                Auth::login($newUser);

                $id = Auth::user()->id;
                $userdata = UserData::create(['user_id' => $id, 'avatar' => $user->avatar]);

                return redirect()->route('home');
            }
            
        } catch(Exception $e) {
                dd($e);
        }
    
    }


}
