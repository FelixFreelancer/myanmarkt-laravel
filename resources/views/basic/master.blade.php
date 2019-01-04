<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>News</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('./assets/css/main.css')}}">
    <link rel="stylesheet" href="{{URL::asset('./assets/css/responisve.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    {{--<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">--}}
    {{--hover menu css--}}
    <link rel="stylesheet" href="{{URL::asset('./assets/css/bootstrap-dropdownhover.css')}}">

    <script src="//cdnjs.cloudflare.com/ajax/libs/sass.js/0.6.3/sass.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="{{URL::asset('./assets/js/jssor.slider-27.5.0.min.js')}}" type="text/javascript"></script>
    {{--hover menu js--}}
</head>

<body>
<div class="header">
    <div class="header-main row">


        <div class="header-logo col-lg-5 col-sm-12">
            <a href="/">
                <div class="header-logo-content">
                    MYAN
                    <div class="header-logo-color">MARKT<div style="text-align: right;">.com</div></div>
                </div>
            </a>
        </div>


        <div class="header-ads col-lg-7 col-sm-12">
            <img src="/assets/img/temp_ads.png" alt="">
            {{--<img src="../../../public/assets/img/temp_ads.png" alt="">--}}
        </div>
    </div>
    <div class="header-category row main-header">
        <div class="header-login" onclick="openNav()">
            @guest
                <i class="material-icons">menu</i> Login
            @else
                <i class="material-icons">menu</i> Menu
                <input type="hidden" id="login_user_name" value="{{Auth::user()->name}}">
            @endguest

        </div>
        <div class="select-region">
            <span>Region:</span>
            {{--<div id="region_select">--}}
                <select name="" >
                    <option value="All">All</option>
                    <option value="Doha">Doha</option>
                    <option value="New York">New York</option>
                </select>
            {{--</div>--}}
        </div>

        <nav class="navbar navbar-expand-lg">
            {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"--}}
                    {{--aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">--}}
                {{--<span class="navbar-toggler-icon">Category</span>--}}
            {{--</button>--}}

            <div class="select-language">
                <div class="language-country">
                    <img src="/assets/img/uk.jpg" alt="">
                </div>
                <!--<div class="language-country-border"></div>-->
                <div class="language-country">
                    <img src="/assets/img/myanmar.png" alt="">
                </div>
            </div>

            <div class="collapse navbar-collapse" data-hover="dropdown" aria-expanded="false">
                {{--<div class="navbar-nav" id="dropdownMenuButton">--}}
                <ul class="nav nav-bar main-category">
                    @foreach($main_categories as $main_category)

                        <li class="dropdown hover-category ">
                                <a href="#" class=" nav-item nav-link menu__item" data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    {{$main_category->name}}
                                </a>
                            <ul class="dropdown-menu dropdownhover-bottom" role="menu" style="">
                                @foreach($categories as $category)
                                    @php
                                        $main_layer_level           = Layer2222::getMainLayerLevel($category->level);
                                        $parent_layer_level         = Layer2222::getParentLevel($category->level);
                                        $current_layer_level        = Layer2222::getCurrentLayer($category->level);
                                        $current_next_layer_level   = Layer2222::getNextLayer($category->level);
                                    @endphp
                                    @if ($current_layer_level == 1 && $main_layer_level == $main_category->level)
                                        <?php
//                                            SELECT MAX(level) AS curmax FROM categories WHERE level > ? AND level < ?', [$request->level, $next_parent_level]
                                            $subcategories = DB::table('categories')->where([['level', '>', $category->level], ['level', '<', $current_next_layer_level]])->get();
                                            if (sizeof($subcategories) > 0 ){
                                                echo '<li class="dropdown">
                                                        <a class="sub-category" data-toggle="dropdown"
                                                        role="button" aria-expanded="false"  href="#">'.$category->name.'
                                                        </a> <i class="fas fa-caret-right"></i>
                                                        <ul class="dropdown-menu dropdownhover-right">';
                                                        foreach ($subcategories as $subcategory){
                                                            echo '<li><a class="sub-category" href="#">'.$subcategory->name.'</a></li>';
                                                        }
                                                echo '</ul></li>';
                                            }else{
                                                echo '<li><a class="sub-category" href="/category/'.$main_category->id.'/'.$category->id.'">'.$category->name.'</a> </li>';

                                            }
                                        ?>
                                    @endif


                                @endforeach

                            </ul>

                        </li>
                    @endforeach
                        {{--@php(exit())--}}
                </ul>
                {{--</div>--}}
            </div>
        </nav>
        <!--</header>-->
    </div>
</div>

<div class="add-posts">
    <div class="add-posts-btn">
        <a href="{{route('user.post.add')}}">
            <button>+ post ad</button>
        </a>
    </div>
    <div class="post-search">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Enter Keywords">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">Search</button>
            </div>
        </div>
    </div>
    <div class="chat-icon">
        Chat <i class='far fa-comment-dots'></i>
    </div>
    <div class="call-icon">
        Call <i class='fas fa-phone'></i>
    </div>
    <div class="chat-icon">
        Email <i class="far fa-envelope"></i>
    </div>
</div>


@yield('content')




<!--login sidebar-->
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    @guest
        <div id="logged_in_user" style="color: white;text-align: center;padding: 0 0 10px; display: none;">

        </div>
    @else
        <div id="logged_in_user" style="color: black;text-align: center;padding: 0 0 10px; display: block;">

        </div>
    @endguest
    <div class="sidenav-auth">
        @guest
            <a href="{{route('login')}}">Login</a>
            <a href="{{route('register')}}">Register</a>
        @else
            <div>Activity</div>
            <?php
            $user_ads_count = DB::table('user_ads')->where('user_id', Auth::user()->id)->get()->count();
            ?>
            <ul>
                <li><a href="{{route('user.ads')}}">Ads ({{$user_ads_count}})</a></li>
                <li><a href="#">Forum Posts</a></li>
                <li><a href="#">Messages</a></li>
                <li><a href="#">Favorite</a></li>
            </ul>
            <a href="{{route('user.settings')}}">Account Settings</a>
            <a href="#">Premium Account</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{csrf_field()}}
            </form>
            <a href="{{route('logout')}}" onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">Logout</a>
        @endguest
    </div>

</div>
</body>
@yield('footer')

<script type="text/javascript">

    // jssor_slider1_starter('slider1_container');
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        var login_user_name = $('#login_user_name').val();
        $('#logged_in_user').text('Welcome ' + login_user_name + '!');
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

</script>
{{--<script type="text/javascript" src="{{URL::asset('./assets/js/hover_menu.js')}}"></script>--}}
<script src="{{URL::asset('./assets/js/bootstrap-dropdownhover.js')}}"></script>


</html>