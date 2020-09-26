<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            'username'=>['required','string','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'=>['required','string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username'=>$data['username'],
            'email' => $data['email'],
            'phone'=>$data['phone'],
            'password' => Hash::make($data['password']),
        ]);
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
