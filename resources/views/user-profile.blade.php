@extends('basic.master')
@section('content')
    <link rel="stylesheet" href="{{asset('./assets/css/user-ads.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/css/user-profile.css')}}">

    <div class="row user-ads-section">
        <div class="col-md-3">
            <div class="user-ads-info">
                user-ads-info
            </div>
        </div>
        <div class="col-md-9 user-ads-list">
            <div style="margin-bottom: 20px;">Profile & Settings</div>

            <div class="col-md-9 user-profile">
                <form name="form" method="post" action="{{ route('user.profile.update')}}">
                    {{csrf_field()}}
                    <div id="first_name-container" class="input-container input-text ">
                        <div class="row ">
                            <label class="col-md-4" for="user_name">Name:</label>
                            <input name="name" placeholder="Name" id="user_name"
                                             value="{{$user_info->name}}" required autofocus
                                             class="col-md-8 input-text">
                            @if ($errors->has('name'))
                                <span class="input-invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                            @endif
                        </div>
                    </div>

                    <div id="email-container"
                         class="input-container input-text {{ $errors->has('email') ? ' is-invalid' : '' }}">
                        <div class="row">
                            <label class="col-md-4" for="user_name">Email:</label>
                            <input name="email" type="email" placeholder="Email" id="email"
                                             value="{{$user_info->email}}" required
                                             class="input-text col-md-8">
                            @if ($errors->has('email'))
                                <span class="input-invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                            @endif
                        </div>
                    </div>

                    <div id="user_phone-container" class="input-container input-text ">
                        <div class="row">
                            <label class="col-md-4" for="user_name">Phone Number:</label>
                            <input type="number" name="phone_number" placeholder="Phone Number"
                                             id="phone_number"
                                             value="{{$user_info->phone_number}}" class="input-text col-md-8"></div>
                    </div>

                    <div id="gender-container" class="input-container input-text ">
                        <div class="row">
                            <label class="col-md-4" for="user_name">Gender:</label>
                            <?php
                                $male_selected = "";
                                $female_selected = "";
                                if ($user_info->gender == 'male') $male_selected = "selected";
                                else $female_selected = "selected";
                            ?>
                            <select name="gender" id="gender" class="input-text col-md-8">
                                <option {{$male_selected}}   value="male">Male</option>
                                <option {{$female_selected}} value="female">Female</option>
                            </select>
                        </div>

                    </div>

                    <div id="age-container" class="input-container input-text ">
                        <div class="row">
                            <label class="col-md-4" for="user_name">Age:</label>
                            <input type="number" name="age" placeholder="Age" id="age" value="{{$user_info->age}}"
                                             class="input-text col-md-8"></div>
                    </div>
                    <?php
                        $regions = ['Doha', 'New York', 'Al Rayyan' ];
                    ?>
                    <div id="city-container" class="input-container input-text ">
                        <div class="row">
                            <label class="col-md-4" for="user_name">Region:</label>
                            <select name="city" id="city" class="input-text col-md-8">
                                <?php
                                    $selected = "";
                                    foreach($regions as $region) {
                                        if ($user_info->city == $region){
                                            $selected = 'selected';
                                        }
                                            echo '<option '.$selected.' value="'.$region.'">'.$region.'</option>';
                                            $selected = "";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div id="password-container"
                         class="input-container input-text password {{ $errors->has('password') ? ' is-invalid' : '' }}">
                        <div class="row">
                            <label class="col-md-4" for="user_name"> New Password:</label>
                            <input type="password" name="password" placeholder="Password"
                                             id="password" value="" class="input-text col-md-8" >
                            @if ($errors->has('password'))
                                <span class="input-invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                            @endif
                        </div>
                        {{--<a target="password" class="toggle-password">show</a>--}}
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
                            <button class="button primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection