<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{$general->web_name}} | 404</title>
    <link rel=icon href="{{asset('images/logo/favicon.png')}}" sizes="20x20" type="image/png">

    <!-- Vendor Stylesheet -->
    <link rel="stylesheet" href="{{asset('user/css/vendor.css')}}">
    <!-- animate -->
    <link rel="stylesheet" href="{{asset('user/css/animate.css')}}">
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{asset('user/css/owl.carousel.min.css')}}">
    <!-- lineawesome -->
    <link rel="stylesheet" href="{{asset('user/css/line-awesome.min.css')}}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{asset('user/css/magnific-popup.css')}}">
    <!-- signin Stylesheet -->
    <link rel="stylesheet" href="{{asset('user/css/signin.css')}}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{asset('user/css/style.css')}}">
    <!-- responsive Stylesheet -->
    <link rel="stylesheet" href="{{asset('user/css/responsive.css')}}">
    <link href="{{asset('admin/plugins/bootoast/src/bootoast.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('user/css/custom.css')}}">
    <link href="{{asset('user/css/color.php?color='.$general->color_code)}}" rel="stylesheet">
    @yield('style')
</head>

<body>


<!-- navbar start -->
<div class="navbar-area navbar-area-2">
    <div class="navbar-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 text-sm-left text-center">
                    <ul class="topbar-left">
                        <li class="topbar-single-info"><i class="fa fa-envelope"></i>{{$general->contact_email}}</li>
                        <li class="topbar-single-info ml-3 ml-lg-0"><i class="fa fa-phone"></i>{{$general->contact_phone}}</li>
                    </ul>
                </div>
                <div class="col-sm-5 text-sm-right text-center">
                    <ul class="topbar-right float-md-right">
                        @foreach($social as $data)
                        <li class="topbar-single-info topbar-social-icon"><a href="{{$data->link}}" target="_blank"><i class="fa fa-{{$data->icon}}"></i></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-area navbar-expand-lg nav-transparent">
        <div class="container nav-container nav-white">
            <div class="responsive-mobile-menu">
                <button class="menu toggle-btn d-block d-lg-none" data-toggle="collapse" data-target="#investon_main_menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-left"></span>
                    <span class="icon-right"></span>
                </button>
            </div>
            <div class="logo">
                <a href="{{url('/')}}"> <img src="{{asset('images/logo/logo.png')}}" alt="logo"></a>
            </div>
            <div class="collapse navbar-collapse" id="investon_main_menu">
                <ul class="navbar-nav menu-open">
                    @auth
                        <li>
                            <a href="{{route('home')}}">{{__('Dashboard')}}</a>
                        </li>

                        <li class="menu-item-has-children">
                            <a href="#">{{__('Deposit')}} <i class="fa fa-angle-down"></i></a>
                            <ul class="sub-menu">
                                <li><a href="{{route('users.showDepositMethods')}}"><i class="fa fa-long-arrow-right"></i>{{__('Add Deposit')}}</a></li>
                                <li><a href="{{route('user.deposit.log')}}"><i class="fa fa-long-arrow-right"></i>{{__('Deposit Log')}}</a></li>
                            </ul>
                        </li>


                        <li class="menu-item-has-children">
                            <a href="#">{{__('Investment')}} <i class="fa fa-angle-down"></i></a>
                            <ul class="sub-menu">
                                <li><a href="{{route('invest.index')}}"><i class="fa fa-long-arrow-right"></i>{{__('Investment Plan')}}</a></li>
                                <li><a href="{{route('invest.log')}}"><i class="fa fa-long-arrow-right"></i>{{__('Invest Log')}}</a></li>
                            </ul>
                        </li>

                        <li class="menu-item-has-children">
                            <a href="#">{{__('Transaction')}} <i class="fa fa-angle-down"></i></a>
                            <ul class="sub-menu">
                                <li><a href="{{route('fund.transfer')}}"><i class="fa fa-long-arrow-right"></i>{{('Fund Transfer')}}</a></li>
                                <li><a href="{{route('transaction.log')}}"><i class="fa fa-long-arrow-right"></i>{{__('Transaction Log')}}</a></li>
                            </ul>
                        </li>

                        <li class="menu-item-has-children">
                            <a href="#">{{__('Withdraw')}} <i class="fa fa-angle-down"></i></a>
                            <ul class="sub-menu">
                                <li><a href="{{route('user.withdraw.method')}}"><i class="fa fa-long-arrow-right"></i>{{__('Withdraw')}}</a></li>
                                <li><a href="{{route('user.withdraw.log')}}"><i class="fa fa-long-arrow-right"></i>{{__('Withdraw Log')}}</a></li>
                            </ul>
                        </li>

                        <li class="menu-item-has-children">
                            <a href="#">{{split_name(auth()->user()->name)[0]}} <i class="fa fa-angle-down"></i></a>
                            <ul class="sub-menu">
                                <li><a href="{{route('profile.index')}}"><i class="fa fa-long-arrow-right"></i>{{__('Profile')}}</a></li>
                                <li><a onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{route('logout')}}"><i class="fa fa-long-arrow-right"></i>{{__('Logout')}}</a></li>
                            </ul>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="display-none">
                            @csrf
                        </form>
                    @else
                        <li>
                            <a href="{{url('/')}}">{{__('Home')}}</a>
                        </li>
                        @foreach($frontMenu as $data)
                            <li>
                                <a href="{{route('single.page',['class' => 'Menu', 'id' =>$data->id])}}">{{$data->title}}</a>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{route('news.index')}}">{{__('News')}}</a>
                        </li>
                        <li>
                            <a href="{{route('contacts.index')}}">{{__('Contact')}}</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">{{__('Account')}} <i class="fa fa-angle-down"></i></a>
                            <ul class="sub-menu">
                                <li><a href="{{route('register')}}"><i class="fa fa-long-arrow-right"></i>{{__('Sign Up')}}</a></li>
                                <li><a href="{{route('login')}}"><i class="fa fa-long-arrow-right"></i>{{__('Sign In')}}</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>
<!-- navbar end -->



    <!-- page-title area start -->
    <div class="page-title-area mg-bottom-105 bref-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <h3 class="title"> {{__('Page Not Found')}} </h3>
                </div>
                <div class="col-sm-6 text-center align-self-center">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url()->previous()}}">{{__('Back')}}</a></li>

                        <li class="breadcrumb-item active" aria-current="page">{{__('404')}}</li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- page-title area end -->



<div class="error-area error-bg">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="error-message">
                        <h3 class="title">{{__('Oopps! Page Not Found')}}</h3>
                        <span class="descr"> {{__('we can’t seem to find the page you’re looking for. Try going back to the previous page or see our Help Center for more information')}}</span>
                        <a href="{{url('/')}}" class="backtohome"><i class="fa fa-home"></i> {{__('Go Home')}}</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

<!-- footer area start -->
<footer class="footer-area">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="footer-widget widget widget-about-us">
                        <a href="{{url('/')}}" class="footer-logo">
                            <img src="{{asset('images/logo/logo.png')}}" alt="footer logo">
                        </a>
                        <p>{!! clean($general->footer_text) !!}</p>
                        <ul class="footer-social social-area-2">
                            @foreach($social as $data)
                                <li><a href="{{$data->link}}" target="_blank"><i class="fa fa-{{$data->icon}}"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-4">
                    <div class="footer-widget widget widget_nav_menu">
                        <h4 class="widget-title">{{__('Links')}} <span class="dot">.</span></h4>
                        <ul>
                            <li><a href="{{route('news.index')}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>{{__('Blog')}}</a></li>
                            <li><a href="{{route('contacts.index')}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>{{__('Contact')}}</a></li>
                            @guest
                                <li><a href="{{route('register')}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>{{__('Sign Up')}}</a></li>
                                <li><a href="{{route('login')}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>{{__('Sign In')}}</a></li>
                            @else
                                <li><a href="{{route('home')}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>{{__('Dashboard')}}</a></li>
                            @endguest
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget widget widget_nav_menu">
                        <h4 class="widget-title">{{__('Others Links')}} <span class="dot">.</span></h4>
                        <ul>
                            @foreach($frontMenu as $data)
                                <li><a href="{{route('single.page',['class' => 'Menu', 'id' =>$data->id])}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>{{$data->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget widget contact-widget">
                        <h4 class="widget-title">{{__('Contact Us')}} <span class="dot">.</span></h4>
                        <p>{!! clean($general->contact_address) !!}</p>
                        <p>{!! clean($general->contact_email) !!}</p>
                        <p>{!! clean($general->contact_phone) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 text-lg-left text-center">
                    <ul class="footer-menu">
                        @auth
                            <li><a href="{{route('users.showDepositMethods')}}">{{__('Add Deposit')}}</a></li>
                            <li><a href="{{route('invest.index')}}">{{__('Investment Plan')}}</a></li>
                            <li><a href="{{route('fund.transfer')}}">{{__('Fund Transfer')}}</a></li>
                        @else
                            <li> <a href="{{url('/')}}">{{__('Home')}}</a></li>
                            @foreach($frontMenu as $data)
                                <li>
                                    <a href="{{route('single.page',['class' => 'Menu', 'id' =>$data->id])}}">{{$data->title}}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-lg-5 text-center text-lg-right">
                    <p class="copyright">{{$general->copyright_text}}</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->

<!-- back to top area start -->
<div class="back-to-top">
    <span class="back-top"><i class="fa fa-angle-up"></i></span>
</div>
<!-- back to top area end -->


<!-- vendor js here -->
<script src="{{asset('user/js/vendor.js')}}"></script>
<!--signin -->
<script src="{{asset('user/js/signin.js')}}"></script>
<!--coundown timer JS-->
<script src="{{asset('user/js/countdown-timer.js')}}"></script>
<!-- magnific popup -->
<script src="{{asset('user/js/jquery.magnific-popup.min.js')}}"></script>
<!-- counterup -->
<script src="{{asset('user/js/jquery.counterup.min.js')}}"></script>
<!-- waypoint -->
<script src="{{asset('user/js/jquery.waypoints.js')}}"></script>
<!-- main js  -->
<script src="{{asset('user/js/main.js')}}"></script>

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
