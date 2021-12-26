<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Hash;
use Auth;
use Str;
use Socialite;

use App\Models\User;
use Carbon\Carbon;

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
    //send the user's request to github 
    public function github(){
        return Socialite::driver('github')->redirect();
    }

    //get oauth request back from github to authenticate user
    public function githubRedirect(){

        $user =  Socialite::driver('github')->user();

        // First find user with email exists or not if does not exist then create user with name and password and authenticate
        $user = User::firstOrCreate([
            'email' => $user->email
        ], [
            'name'      => $user->name,
            'password'  => Hash::make(Str::random(24)),
            'email_verified_at' => now()
        ]);

        Auth::login($user, true);

        return redirect('/home');

    }

    public function google(){
        return Socialite::driver('google')->redirect();
    }

    public function googleRedirect(){

        try {
      
            $user = Socialite::driver('google')->user();
       
            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect(route('home'));
       
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'email_verified_at' => now(),
                    'password' => Hash::make(Str::random(24))
                ]);
      
                Auth::login($newUser);
      
                return redirect(route('home'));
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }
}
