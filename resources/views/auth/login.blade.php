@extends('layouts.auth')

@section('content')
 
<div class="padding-15"   >

{{-- <img src="{{asset('frontend/img/Icon awesome-eye.png')}}" class="w-16" alt="eye">--}}
    <div class="login-box">
        <!-- login form -->
        <form method="POST" action="{{ route('login') }}" class="sky-form boxed">
            @csrf
            <header><i class="fa fa-users"></i> {{ __('Sign In') }}</header>
                    <!--
                    <div class="alert alert-danger noborder text-center weight-400 nomargin noradius">
                        Invalid Email or Password!
                    </div>

                    <div class="alert alert-warning noborder text-center weight-400 nomargin noradius">
                        Account Inactive!
                    </div>

                    <div class="alert alert-default noborder text-center weight-400 nomargin noradius">
                        <strong>Too many failures!</strong> <br />
                        Please wait: <span class="inlineCountdown" data-seconds="180"></span>
                    </div>
                -->

                @error('email')
                <div class="alert alert-danger noborder text-center weight-400 nomargin noradius">
                    {{ $message }}
                </div>
                @enderror

                @error('password')
                <div class="alert alert-danger noborder text-center weight-400 nomargin noradius">
                    {{ $message }}
                </div>
                @enderror
                <fieldset>  
                    <section>
                        <label class="label">{{ __('Email Address') }}</label>
                        <label class="input">
                            <i class="icon-append fa fa-envelope"></i>
                             <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <span class="tooltip tooltip-top-right">Email Address</span>
                        </label>
                    </section>
                    <section>
                        <label class="label">{{ __('Password') }}</label>
                        <label class="input">
                            <i id="toggle-password" class="icon-append fa fa-eye"></i>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        </label>
                        
                        
                        <label class="checkbox">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><i></i>{{ __('Keep me logged in') }}
                        </label>
                    </section>
                </fieldset>
                <footer>
                    <button type="submit" class="btn btn-primary pull-right">{{ __('Sign In') }}</button>
                    <div class="forgot-password pull-left">
                       @if (Route::has('password.request'))
                       <a href="#">{{ __('Forgot Your Password?') }}?</a> <br />
                       @endif
                       <!-- <a href="page-register.html"><b>Need to Register?</b></a> -->
                   </div>
               </footer>
           </form>
           <!-- /login form -->
           <hr />
       </div>
   </div>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

   <script>
            $(document).ready(function() {
                $("#toggle-password").click(function() {
                const passwordInput = $("#password");
                const icon = $(this).find("i");
                
                if (passwordInput.attr("type") === "password") {
                    passwordInput.attr("type", "text");
                    icon.removeClass("fa-eye");
                    icon.addClass("fa-eye-slash");
                } else {
                    passwordInput.attr("type", "password");
                    icon.removeClass("fa-eye-slash");
                    icon.addClass("fa-eye");
                }
                });
            });
            </script>
   
@endsection
