@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{--<div class="col-md-8">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-header">{{ __('Register') }}</div>--}}

                    {{--<div class="card-body">--}}
                        {{--<form method="POST" action="{{ route('register') }}">--}}
                            {{--@csrf--}}

                            {{--<div class="form-group row">--}}
                                {{--<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="name" type="text"--}}
                                           {{--class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"--}}
                                           {{--name="name" value="{{ old('name') }}" required autofocus>--}}

                                    {{--@if ($errors->has('name'))--}}
                                        {{--<span class="invalid-feedback" role="alert">--}}
            {{--<strong>{{ $errors->first('name') }}</strong>--}}
            {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row">--}}
                                {{--<label for="email"--}}
                                       {{--class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="email" type="email"--}}
                                           {{--class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"--}}
                                           {{--name="email" value="{{ old('email') }}" required>--}}

                                    {{--@if ($errors->has('email'))--}}
                                        {{--<span class="invalid-feedback" role="alert">--}}
            {{--<strong>{{ $errors->first('email') }}</strong>--}}
            {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row">--}}
                                {{--<label for="password"--}}
                                       {{--class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="password" type="password"--}}
                                           {{--class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"--}}
                                           {{--name="password" required>--}}

                                    {{--@if ($errors->has('password'))--}}
                                        {{--<span class="invalid-feedback" role="alert">--}}
            {{--<strong>{{ $errors->first('password') }}</strong>--}}
            {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row">--}}
                                {{--<label for="password-confirm"--}}
                                       {{--class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="password-confirm" type="password" class="form-control"--}}
                                           {{--name="password_confirmation" required>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row mb-0">--}}
                                {{--<div class="col-md-6 offset-md-4">--}}
                                    {{--<button type="submit" class="btn btn-primary">--}}
                                        {{--{{ __('Register') }}--}}
                                    {{--</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="register site-body">
                <div class="signup-container">
                    <div class="header-container undefined"><a href="{{route('login')}}" class="close-icon"></a></div>
                    <div id="bodyContainer" class="body-container center">
                        <div class="signup-form">
                            <div class="page-header-container">
                                <h1 class="align-center">Sign Up</h1>
                            </div>
                            <form name="form" method="post" action="{{ route('register')}}">
                                {{csrf_field()}}
                                <div id="first_name-container" class="input-container input-text ">
                                    <div class=""><input name="name" placeholder="Name" id="user_name"
                                                         value="{{old('name')}}" required autofocus
                                                         class="input-text">
                                        @if ($errors->has('name'))
                                            <span class="input-invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div id="email-container"
                                     class="input-container input-text {{ $errors->has('email') ? ' is-invalid' : '' }}">
                                    <div class=""><input name="email" type="email" placeholder="Email" id="email"
                                                         value="{{old('email')}}" required
                                                         class="input-text">
                                        @if ($errors->has('email'))
                                            <span class="input-invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div id="user_phone-container" class="input-container input-text {{ $errors->has('phone_number') ? ' is-invalid' : '' }}">
                                    <div class="" id="phone_number_validation">
                                        <input type="text" name="phone_number" placeholder="Phone Number"
                                               id="phone_number" maxlength="12"
                                               onblur="isValidationLength()"
                                               onkeypress="return isNumberKey(event)"   value="{{old('phone_number')}}" class="input-text">
                                        @if ($errors->has('phone_number'))
                                            <span class="input-invalid-feedback" role="alert">
                                                <strong>Phone number must be 8 letters at least</strong>
                                            </span>
                                        @endif
                                        <div id="phone_number_alert_validation"></div>
                                    </div>
                                </div>

                                <div id="gender-container" class="input-container input-text ">
                                    <div class="">
                                        <select name="gender" id="gender" class="input-text ">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>

                                </div>

                                <div id="age-container" class="input-container input-text ">
                                    <div class="">
                                        <select id="age" class="input-text" name="age">
                                            <option selected value="16">16</option>
                                        <?php
                                            for ($i = 17 ; $i < 91 ; $i++){
                                                echo '<option value="'.$i.'">'.$i.'</option>';

                                            }
                                        ?>
                                        </select>
                                        {{--<input type="number" name="age" placeholder="Age" id="age" value=""--}}
                                                         {{--class="input-text">--}}
                                    </div>
                                </div>

                                <div id="city-container" class="input-container input-text ">
                                    <div class="">
                                        <select name="city"  id="city"  class="input-text">
                                            <option value="Doha">Doha</option>
                                            <option value="New York">New York</option>
                                            <option value="new york">New York</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="password-container" class="input-container input-text password {{ $errors->has('password') ? ' is-invalid' : '' }}">
                                    <div class="">
                                        <input type="password" name="password" placeholder="Password"
                                                         id="password" value="" class="input-text" required>
                                        @if ($errors->has('password'))
                                            <span class="input-invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{--<a target="password" class="toggle-password">show</a>--}}
                                </div>

                                <div id="confirm-password-container" class="input-container input-text password">
                                    <div class="">
                                        <input type="password" name="password_confirmation" placeholder="Confirm Password"
                                                         id="password-confirm" value="" class="input-text" required>
                                    </div>
                                </div>


                                {{--<div>--}}
                                {{--<div class="grecaptcha-badge" data-style="bottomright"--}}
                                {{--style="width: 256px; height: 60px; transition: right 0.3s ease 0s; position: fixed; bottom: 14px; right: -186px; box-shadow: gray 0px 0px 5px;">--}}
                                {{--<div class="grecaptcha-logo">--}}
                                {{--<iframe src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6Lf_DDoUAAAAACBY86cGXy0yWwEuky012EY-o_GC&amp;co=aHR0cHM6Ly9kdWJhaS5kdWJpenpsZS5jb206NDQz&amp;hl=en&amp;type=image&amp;v=v1546842739564&amp;theme=light&amp;size=invisible&amp;badge=bottomright&amp;cb=e3reprkl38hp"--}}
                                {{--width="256" height="60" role="presentation" name="a-25vxdyr7nd8w"--}}
                                {{--frameborder="0" scrolling="no"--}}
                                {{--sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe>--}}
                                {{--</div>--}}
                                {{--<div class="grecaptcha-error"></div>--}}
                                {{--<textarea id="g-recaptcha-response-2" name="g-recaptcha-response"--}}
                                {{--class="g-recaptcha-response"--}}
                                {{--style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                <div>
                                    <div class="button-container">
                                        <button class="button primary" type="submit">Sign up</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        //only number validation function
        function isNumberKey(evt)
        {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
        function isValidationLength() {
           var phone_number = $('#phone_number').val();
           if (phone_number.length < 8) {
               $('#phone_number_alert_validation').html('<span id="phoneNumber-invalid-feedback" class="input-invalid-feedback" role="alert">\n' +
                   '                   <strong>Phone Number must be 8 letter at least ' +
                   '                   </span>');

           }else{
               $('#phoneNumber-invalid-feedback').hide();
           }
        }
    </script>
@endsection
