@extends('layouts.app')

@section('content')
<div class="container col-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                         <p style="text-align: center;font-weight: bold;font-size: 27px">Instagram</p>
                         <center>
                         <p style="font-size: 20px;color: #a29898;"><strong>Sign up to see photos and videos from your friends.</strong></p>
                         <a  class="btn btn-fb btn-block" href="{{ route('social.register','facebook') }}" style="background: #0095f6"><i style="color: white;font-size: 20px;padding: 10px" class="faI fa  fa-facebook-f left"></i> <span style="color: white;font-size: 17px">Log in with Facebook</span></a>
                         <a  class="btn btn-fb btn-block" href="{{route('social.register','github')}}" style="background: #0095f6"><i style="color: white;font-size: 23px;padding: 10px;" class="faI fa fab fa-github"></i> <span style="color: white;font-size: 17px;padding-left: 5px">Log in with Github</span></a>
    
                        <hr>
                          

                        <div class="form-group row">
                            

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full Name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <input type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="User Name" name="username"required>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"  placeholder="E-mail" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <input type="text" id="defaultRegisterPhonePassword" class="form-control" placeholder="Phone number" aria-describedby="defaultRegisterFormPhoneHelpBlock" name="phone"required >
                        <br>
                        <div class="form-group row">

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info btn-block"  style="padding: 10px;background: #33b5e5;border: none;">
                                    {{ __('Register') }}
                                </button>
                            </div>

                        </div>
                        <br>
                        <div style="color: #8e8e8e;font-size: 17px">
            
                     <p>By signing up, you agree to our Terms , Data Policy and Cookies Policy .</p>
                    </div>
     
                   <hr>
                        <!-- Register -->
                        <p>Have an account?
                            <a href="">Log in</a>
                        </p>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
