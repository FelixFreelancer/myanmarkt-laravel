@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
            {{--<div class="card-header">{{ __('Login') }}</div>--}}

            {{--<div class="card-body">--}}
            {{--<form method="POST" action="{{ route('login') }}">--}}
            {{--@csrf--}}

            {{--<div class="form-group row">--}}
            {{--<label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

            {{--<div class="col-md-6">--}}
            {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>--}}

            {{--@if ($errors->has('email'))--}}
            {{--<span class="invalid-feedback" role="alert">--}}
            {{--<strong>{{ $errors->first('email') }}</strong>--}}
            {{--</span>--}}
            {{--@endif--}}
            {{--</div>--}}
            {{--</div>--}}

            {{--<div class="form-group row">--}}
            {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

            {{--<div class="col-md-6">--}}
            {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

            {{--@if ($errors->has('password'))--}}
            {{--<span class="invalid-feedback" role="alert">--}}
            {{--<strong>{{ $errors->first('password') }}</strong>--}}
            {{--</span>--}}
            {{--@endif--}}
            {{--</div>--}}
            {{--</div>--}}

            {{--<div class="form-group row">--}}
            {{--<div class="col-md-6 offset-md-4">--}}
            {{--<div class="form-check">--}}
            {{--<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

            {{--<label class="form-check-label" for="remember">--}}
            {{--{{ __('Remember Me') }}--}}
            {{--</label>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}

            {{--<div class="form-group row mb-0">--}}
            {{--<div class="col-md-8 offset-md-4">--}}
            {{--<button type="submit" class="btn btn-primary">--}}
            {{--{{ __('Login') }}--}}
            {{--</button>--}}

            {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
            {{--{{ __('Forgot Your Password?') }}--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</form>--}}
            <div class="login" id="login_with_facebook">
                <div class="header-body-group">
                    <div class="header-container undefined"></div>
                    <div id="bodyContainer" class="body-container center">
                        <div class="login-overlay">
                            <div class="in-page-logo-container">
                                <div class="dubizzle-logo"></div>
                            </div>
                            <p class="you-have-to-be-logged-in">Log in or Sign up to continue</p>
                            {{--href="{{url('/redirect')}}" target="_blank" onclick="facebookLogin();"--}}
                            <a href="{{url('/redirect')}}">
                                <button class="button facebook bounceIn"><span class="fb-logo"></span>
                                    Continue with Facebook
                                </button>
                            </a>
                            {{--{{route('login.email')}}, {{route('register.email')}}--}}
                            <div class="login-links-wrapper">
                                <a class="lnk-action" href="javascript:void(0);" onclick="loginForm();">
                                    Log in with email
                                </a><span class="lnk-separator"></span><a
                                        class="lnk-action lnk-to-signup" href="{{ route('register') }}">Sign
                                    up with email</a></div>
                        </div>
                    </div>
                </div>
                <div id="footerContainer" class="footer-container ">
                    <div class="terms-and-condition">By signing up you agree to our
                        <a target="_blank" class="lnk-action" href="/terms/">Terms
                            and Conditions</a>
                        <a class="lnk-action" target="_blank" href="/privacy/">Privacy
                            Policy</a>
                    </div>
                </div>
            </div>

            <div class="site-body" id="login_with_email" >
                <div class="login-form">
                    <div class="header-body-group">
                        <div class="header-container undefined"><a class="close-icon" onclick="returnFacebook();"></a></div>
                        <div id="bodyContainer" class="body-container center">
                            <div class="login-form-fields">
                                <div class="page-header-container"><h1 class="align-center">
                                        Log in with your email
                                    </h1></div>
                                <form name="form" method="post" action="{{route('login')}}">
                                    {{csrf_field()}}
                                    <div id="email-container" class="input-container input-text ">
                                        <div class=""><input name="email" placeholder="Email" id="email" value=""
                                                             class="input-text"></div>
                                    </div>
                                    <div id="password-container" class="input-container input-text password">
                                        <div class=""><input type="password" name="password" placeholder="Password"
                                                             id="password" value="" class="input-text"></div>
                                        {{--<a target="password" class="toggle-password">show</a>--}}
                                        </div>
                                    <div>
                                        <div class="link-container"><a class="forgot-password-lnk">Forgot your
                                                password?</a></div>
                                        <div class="button-container">
                                            <button class="button primary" type="submit">Log in</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="toaster-container"></div>--}}
            </div>
        </div>
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
    </div>
    <script>
        function facebookLogin() {
            window.open('/redirect', '_blank', "width=400,height=400");
        }

        function loginForm() {
            $('#login_with_facebook').css('display', 'none');
            $('#login_with_email').css('display', 'block');
        }
        function returnFacebook() {
            $('#login_with_facebook').css('display', 'block');
            $('#login_with_email').css('display', 'none');
        }
    </script>
@endsection
