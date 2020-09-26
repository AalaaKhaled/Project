<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\AuthProvider;
use App\User;



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

    public function redirectToProvider($provider) {
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider) {

        try{

           $socialUser = Socialite::driver($provider)->stateless()->user();

        }catch(\Exception $e){
           return redirect('/');
        }

      // $user = Socialite::driver($provider)->stateless()->user();
        
       $socialProvider = AuthProvider::where('provider_user_id', $socialUser->getId())->first();
       if(!$socialProvider){

        $user = User::firstOrCreate(
         ['email'=>$socialUser->getEmail()],
         ['name'=>$socialUser->getName(),'username'=>$socialUser->getNickname()]
         
        );
        $user->authProviders()->create(
         ['provider_user_id'=>$socialUser->getId(),'provider'=> $provider]
        );

       }else{
        $user = $socialProvider->user;
       }

       auth()->login($user);
      //dd($socialUser);
       return redirect('/home');
         /*
       $providerUser = \App\AuthProvider::where('provider_user_id', $user->getId())
       ->where('provider', $provider)->first();
        if ($providerUser){
            return response();
        }
       Auth::user()->authProviders()->save(
                new \App\AuthProvider([
                    'provider'         => $provider,
                    'provider_user_id' => $user->getId()
                        ])
        );
        */
    }

}
