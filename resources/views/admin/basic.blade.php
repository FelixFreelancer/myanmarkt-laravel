<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="GeniusOcean Admin Panel.">
    <meta name="author" content="GeniusOcean">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--<link rel="icon" type="image/png" href="{{url('/')}}/assets/images/{{$settings[0]->favicon}}" />--}}

    {{--<title>{{$settings[0]->title}} - Admin Panel</title>--}}
    <title> Admin Panel</title>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('assets/css/admin-bootstrap.min.css')}}" rel="stylesheet">
    {{--<link href="{{ URL::asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">--}}
    <link href="{{ URL::asset('assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/octicons/3.5.0/octicons.min.css" rel="stylesheet">
    {{--<link href="{{ URL::asset('assets/css/bootstrap-colorpicker.css')}}" rel="stylesheet">--}}
    {{--bootstrap select css--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    {{--admin form builder--}}
    <link rel="stylesheet" href="{{URL::asset('assets/css/admin-category.css')}}">

    <!----------------------------------------->
    <!--------------- Custom CSS -------------->
    <!----------------------------------------->
    <link href="{{ URL::asset('assets/css/genius-admin.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/main.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/css/form-builder.css')}}" rel="stylesheet" type="text/css" />
    <!----------------------------------------->
    <!--------------- Custom CSS -------------->
    <!----------------------------------------->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<div id="wrapper"><!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{!! url('admin/dashboard') !!}">
                {{--<img class="logo" src="{!! url('assets/images/logo') !!}/{{$settings[0]->logo}}" alt="LOGO">--}}
                admin image
            </a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">

            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="fa fa-angle-down"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="{!! url('admin/adminprofile') !!}"><i class="fa fa-fw fa-user"></i> Edit Profile</a></li>
                    <li><a href="{!! url('admin/adminpassword') !!}"><i class="fa fa-fw fa-cog"></i> Change Password</a></li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-fw fa-power-off"></i> Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                {{--<li>--}}
                    {{--<a href="{!! url('admin/dashboard') !!}"><i class="fa fa-fw fa-home"></i>  Dashboard</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="{!! url('admin/orders') !!}"><i class="fa fa-fw fa-usd"></i> Orders</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="{!! url('admin/products') !!}"><i class="fa fa-fw fa-shopping-cart"></i> Products</a>--}}
                {{--</li>--}}

                {{--<li>--}}
                    {{--<a href="{!! url('admin/withdraws') !!}"><i class="fa fa-fw fa-bank"></i> Withdraws</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="{!! url('admin/vendors') !!}"><i class="fa fa-fw fa-group"></i> Vendors</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="{!! url('admin/customers') !!}"><i class="fa fa-fw fa-user"></i> Customers</a>--}}
                {{--</li>--}}
                <li>
                    <a href="{!! url('admin/categories') !!}"><i class="fa fa-fw fa-sitemap"></i> Manage Category</a>
                </li>
                <li>
                    <a href="{!! url('admin/categories-fields/0') !!}"><i class="fa fa-fw fa-sitemap"></i> Manage Category fields</a>
                </li>
                {{--<li>--}}
                    {{--<a href="{!! url('admin/sliders') !!}"><i class="fa fa-fw fa-photo"></i> Slider Settings</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="{!! url('admin/service') !!}"><i class="fa fa-fw fa-tasks"></i> Service Section</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="{!! url('admin/testimonial') !!}"><i class="fa fa-fw fa-quote-right"></i> Testimonial Section</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="{!! url('admin/themecolor') !!}"><i class="fa fa-fw fa-paint-brush"></i> Theme Color Settings</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="{!! url('admin/pagesettings') !!}"><i class="fa fa-fw fa-file-code-o"></i> Page Settings</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="{!! url('admin/social') !!}"><i class="fa fa-fw fa-paper-plane"></i> Social Settings</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="{!! url('admin/tools') !!}"><i class="fa fa-fw fa-wrench"></i> Seo Tools</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="{!! url('admin/settings') !!}"><i class="fa fa-fw fa-cogs"></i> General Settings</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="{!! url('admin/subscribers') !!}"><i class="fa fa-fw fa-group"></i> Subscribers</a>--}}
                {{--</li>--}}

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    @yield('content')

</div><!-- /#wrapper -->
<!-- /#wrapper -->
<script>
    var baseUrl = '{!! url('/') !!}';
</script>
<!-- jQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
{{--<script src="{{ URL::asset('assets/js/jquery.js')}}"></script>--}}
<script src="{{ URL::asset('./assets/js/jquery.smooth-scroll.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>

{{--<script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>--}}
<script src="{{ URL::asset('./assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('./assets/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('./assets/js/bootstrap-tagsinput.js')}}"></script>
{{--<script src="{{ URL::asset('assets/js/bootstrap-colorpicker.js')}}"></script>--}}
<!-- Switchery -->
<script src="{{ URL::asset('./assets/js/bootstrap-toggle.min.js')}}"></script>
{{--<script type="text/javascript" src="{{ URL::asset('assets/js/plugin/nicEdit.js')}}"></script>--}}
<script type="text/javascript" src="{{ URL::asset('./assets/js/admin-genius.js')}}"></script>
{{--------------------------------------}}
{{--form builder script import----------}}
{{--------------------------------------}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{URL::asset('./assets/js/sjfb-builder.js')}}" type="text/javascript" ></script> <!-- form builder -->
<script src="{{URL::asset('./assets/js/sjfb-html-generator.js')}}" type="text/javascript" ></script> <!-- form generator -->
{{--------------------------------------}}
{{--form builder script import----------}}
{{--------------------------------------}}

{{--boostrap select script--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
<script>
    {{--$("#maincats").change(function () {--}}
        {{--$("#subs").html('<option value="">Select Sub Category</option>');--}}
        {{--$("#subs").attr('disabled',true);--}}
        {{--$("#childs").html('<option value="">Select Sub Category</option>');--}}
        {{--$("#childs").attr('disabled',true);--}}
        {{--var mainid = $(this).val();--}}
        {{--$.get('{{url('/')}}/subcats/'+mainid, function(response){--}}
            {{--$("#subs").attr('disabled',false);--}}
            {{--$.each(response, function(i, cart){--}}
                {{--$.each(cart, function (index, data) {--}}
                    {{--$("#subs").append('<option value="'+data.id+'">'+data.name+'</option>');--}}
                    {{--//console.log('index', data)--}}
                {{--})--}}
            {{--})--}}
        {{--});--}}
    {{--});--}}
    {{--$("#subs").change(function () {--}}
        {{--$("#childs").html('<option value="">Select Sub Category</option>');--}}
        {{--$("#childs").attr('disabled',true);--}}
        {{--var mainid = $(this).val();--}}
        {{--$.get('{{url('/')}}/childcats/'+mainid, function(response){--}}
            {{--$("#childs").attr('disabled',false);--}}
            {{--$.each(response, function(i, cart){--}}
                {{--$.each(cart, function (index, data) {--}}
                    {{--$("#childs").append('<option value="'+data.id+'">'+data.name+'</option>');--}}
                    {{--//console.log('index', data)--}}
                {{--})--}}
            {{--})--}}
        {{--});--}}
    {{--});--}}


</script>
@yield('footer')
</body>
</html>

