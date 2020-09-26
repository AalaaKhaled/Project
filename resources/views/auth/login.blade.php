@extends('layouts.app')

@section('content')
<div class="container col-5 ">
    @if(session('msg'))
<div class="alert alert-success" role="alert">
 {{session('msg')}}
</div>
  @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body ">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                         <p style="text-align: center;font-weight: bold;font-size: 27px">Instagram</p>

                        <br>
                        <center>
                        <div class="form-group row">
                            
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="E-mail" value="{{ old('email') }}" required autocomplete="email" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row"> 
                           

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info btn-block" style="padding: 10px;background: #33b5e5;border: none;">
                                    {{ __('Login') }}
                                </button>
                                <hr>

                                <p>or sign in with:</p>
                                    <a href="{{ route('social.login','facebook') }}" class="mx-2" role="button"><i class="fa fab faI fa-facebook-f light-blue-text"></i></a>
                                    
                                    <a href="{{route('social.login','github')}}" class="mx-2" role="button"><i class="faI fa fab fa-github light-blue-text"></i></a>
                              <div>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                                 <p>Not a member?
                                  <a href="">Register</a>
                                </p>
                            </div>
                        </div>

                    
                       </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
