<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{$general->web_name}} | @yield('title') </title>
    <link rel="icon" href="{{asset('images/logo/favicon.png')}}" type="image/gif" sizes="16x16">
    <!-- Bootstrap -->
    <link href="{{asset('admin/plugins/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('admin/css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="{{asset('admin/css/prettify.min.css')}}" rel="stylesheet">

    <link href="{{asset('admin/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- Custom styling plus plugins -->
    <link href="{{asset('admin/plugins/build/css/custom.min.css')}}" rel="stylesheet">

    <link href="{{asset('admin/plugins/bootoast/src/bootoast.css')}}" rel="stylesheet">

    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">

    @yield('style')

</head>
@auth('admin')
<body class="nav-md">
@else
    <body class="bg-login">
@endif
<div class="container body">
    @auth('admin')
    <div class="main_container">
        @include('admin.layouts.sidebar')
        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                    <ul class=" navbar-right">
                        <li class="nav-item dropdown open padding-left-15">
                            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                <img src="{{asset('admin/images/img.jpg')}}" alt="">{{auth()->guard('admin')->user()->name}}
                            </a>
                            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"  href="{{route('admin.changePass')}}"> @lang('Profile')</a>
                                <a class="dropdown-item"  href="{{route('admin.logout')}}"><i class="fa fa-sign-out pull-right"></i> @lang('Log Out')</a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
           @yield('content')
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
            <div class="pull-right">
                {{$general->copyright_text}}
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
        @else
        @yield('content')
    @endif
</div>


<!-- jQuery -->
<script src="{{asset('admin/js/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('admin/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('admin/js/fastclick.js')}}"></script>
<!-- bootstrap-wysiwyg -->
<script src="{{asset('admin/js/bootstrap-wysiwyg.min.js')}}"></script>
<script src="{{asset('admin/js/jquery.hotkeys.js')}}"></script>
<script src="{{asset('admin/js/prettify.js')}}"></script>
<script src="{{asset('admin/js/bootstrap-progressbar.min.js')}}"></script>
<!-- Custom Theme Scripts -->
<script src="{{asset('admin/plugins/build/js/custom.min.js')}}"></script>

<script src="{{asset('admin/plugins/bootoast/dist/bootoast.min.js')}}"></script>

@yield('script')

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            bootoast.toast({
                message: '{{ $error }}',
                type: 'warning',
                icon:'exclamation-sign',
                position:'top',
            });
        </script>
    @endforeach
@endif

@if(session()->has('success'))
    <script>
        bootoast.toast({
            message: '{{ session()->get('success') }}',
            type: 'success',
            position:'top',
        });
    </script>
@endif

@if(session()->has('alert'))
    <script>
        bootoast.toast({
            message: '{{ session()->get('alert') }}',
            type: 'danger',
            position:'top',
        });
    </script>
@endif

</body>
</html>
