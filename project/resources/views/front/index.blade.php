@extends('front.layouts.master')
@section('title',__('Home'))
@section('content')
    <!-- work area start -->
    <div class="work-area common-pd-2 bg-none">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-4 col-md-6">
                    <div class="single-work text-center mg-top-180">
                        <span class="common-icon-circle bg-smile-green"><img src="{{asset('images/work/'.$workAreaFirst->icon)}}" alt="icon"></span>
                        <h4><a href="#">{{$workAreaFirst->title}}</a></h4>
                        <p>{{short_text($workAreaFirst->description,25)}}</p>
                        <a class="btn btn-plus" href="{{route('single.page',['class' => 'Work','id'=>$workAreaFirst->id])}}"><i class="fa fa-plus"></i></a>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="row">
                        @foreach($workArea as $data)
                        <div class="col-lg-6 col-md-6">
                            <div class="single-work text-center">
                                <span class="common-icon-circle bg-pink"><img src="{{asset('images/work/'.$data->icon)}}" alt="icon"></span>
                                <h4><a href="#">{{$data->title}}</a></h4>
                                <p>{{short_text($data->description,25)}}</p>
                                <a class="btn btn-plus" href="{{route('single.page',['class' => 'Work','id'=>$data->id])}}"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        @endforeach


                        <div class="col-lg-12 mb-5 mb-mg-0">
                            <div class="single-input-wrap text-center text-lg-right">
                                <input placeholder="Open an account - Enter you email" type="text" class="single-input">
                                <a class="btn btn-basic" href="{{route('register')}}">{{__('GO ON')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- work area end -->



    <div class="shape-4">
        <!-- video-area start -->
        <div class="video-area-2 common-pd-bottom right-line-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 align-self-center">
                        <div class="section-title">
                            <h5 class="subtitle"><span></span>{{$general->about_head}}</h5>
                            <h3 class="title">{{$general->about_title}}</h3>
                            <p>{{short_text($general->about_body,50)}}</p>
                        </div>
                        <a class="btn btn-basic top-right-radius-0" href="{{route('single.page',['class' => 'About'])}}" onclick="window.location.href= {{route('single.page',['class' => 'About'])}}">Find Out More</a>
                        <a class="video-play-btn" href="{{$general->about_video_url}}" data-effect="mfp-zoom-in"><i class="fa fa-play"></i></a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-about text-center bg-gradient">
                            <div class="thumb">
                                <img src="{{asset('images/about/one.png')}}" alt="icon">
                            </div>
                            <h5><a href="{{route('single.page',['class' => 'About1'])}}">{{$general->single_about1_title}}</a></h5>
                            <p>{{short_text($general->single_about1_description, 20)}}</p>
                            <a class="btn btn-plus" href="{{route('single.page',['class' => 'About1'])}}"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-about text-center bg-purple">
                            <div class="thumb">
                                <img src="{{asset('images/about/two.png')}}" alt="icon">
                            </div>
                            <h5><a href="{{route('single.page',['class' => 'About2',])}}">{{$general->single_about2_title}}</a></h5>
                            <p>{{short_text($general->single_about2_description, 20)}}</p>
                            <a class="btn btn-plus" href="{{route('single.page',['class' => 'About2'])}}"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- video-area end -->
    </div>


    <div class="shape-2">
        <!-- why-choose-us-area start -->
        <div class="why-choose-us-area pd-bottom-85">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 align-self-center">
                        <div class="thumb item-bounce d-none d-lg-block">
                            <img src="{{url('/')}}/public/user/img/why-choose-us/01.png" alt="img">
                        </div>
                    </div>
                    <div class="col-lg-7">
                       @foreach($services as $key => $data)
                        <div class="single-facility media">
                            <span class="number">{{$key+1}}</span>
                            <div class="thumb align-self-center">
                                <img src="{{asset('images/service/'.$data->icon)}}" alt="icon">
                            </div>
                            <div class="facility-details media-body">
                                <h5>{{$data->title}}</h5>
                                <p>{{$data->description}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- why-choose-us-area end -->

        <!-- pricing-area start -->
        <div class="pricing-area pd-bottom-85">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <h5 class="subtitle"><span></span>{{$general->invest_head}}</h5>
                            <h3 class="title">{{$general->invest_title}}</h3>
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <p class="mb-0">{{$general->invest_description}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="pricing-tab">
                            <nav>
                                <div class="nav nav-tabs text-center" id="nav-tab">
                                    @if(count($roi_plans))
                                    <a class="btn ml-0 nav-item nav-link active" id="nav-monthly-tab" data-toggle="tab" href="#nav-roi">{{__('ROI Investment')}}</a>
                                    @endif
                                    @if(count($fixed_plans))
                                    <a class="btn nav-item nav-link" id="nav-yearly-tab" data-toggle="tab" href="#nav-fixed">{{__('Fixed Investment')}}</a>
                                    @endif
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-roi">
                                    <div class="row justify-content-center">
                                        @foreach($roi_plans as $data)
                                            <div class="col-lg-4 col-md-6">
                                                <div class="single-pricing-wrap text-center">
                                                    <span class="animate-dots"></span>
                                                    <div class="price">{{$data->percent}}%</div>
                                                    <div class="thumb">
                                                        <img src="{{url('/')}}/public/user/img/pricing/01.png" alt="icon">
                                                    </div>
                                                    <h5>{{$data->name}}</h5>
                                                    <ul>
                                                        <li><a href="#" onclick="event.preventDefault()">{{__('Minimum Deposit')}} {{$data->min_amount}}{{$general->currency}}</a></li>
                                                        <li><a href="#" onclick="event.preventDefault()">{{__('Maximum Deposit')}} {{$data->max_amount}}{{$general->currency}}</a></li>
                                                        <li><a href="#" onclick="event.preventDefault()">{{__('ROI Action')}} {{$data->action}} {{__('TIMES')}}</a></li>
                                                        <li><a href="#" onclick="event.preventDefault()">
                                                                {{$data->percent}}% {{__('Payback')}}
                                                                @switch($data->period)
                                                                    @case(1)
                                                                    {{__('Hourly')}}
                                                                    @break
                                                                    @case(24)
                                                                    {{__('Daily')}}   @break
                                                                    @case(168)
                                                                    {{__('Weekly')}}   @break
                                                                    @case(720)
                                                                    {{__('Monthly')}}   @break
                                                                    @case(2880)
                                                                    {{__('Quarterly')}}   @break
                                                                    @case(8640)
                                                                    {{__('Yearly')}}   @break
                                                                @endswitch
                                                            </a></li>
                                                    </ul>
                                                    <a class="btn btn-plus" href="{{route('invest.index')}}"><i class="fa fa-plus"></i></a>
                                                    <a class="btn btn-white" href="{{route('invest.index')}}">{{__('Buy Now')}}</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-fixed">
                                    <div class="row justify-content-center">
                                        @foreach($fixed_plans as $data)
                                            <div class="col-lg-4 col-md-6">
                                                <div class="single-pricing-wrap text-center">
                                                    <span class="animate-dots"></span>
                                                    <div class="price">{{$data->percent}}%</div>
                                                    <div class="thumb">
                                                        <img src="{{url('/')}}/public/user/img/pricing/01.png" alt="icon">
                                                    </div>
                                                    <h5>{{$data->name}}</h5>
                                                    <ul>
                                                        <li><a href="#" onclick="event.preventDefault()">{{__('Deposit')}} {{$data->fixed_amount}}{{$general->currency}}</a></li>
                                                        <li><a href="#" onclick="event.preventDefault()">{{__('ROI Action Lifetime TIMES')}}</a></li>
                                                        <li><a href="#" onclick="event.preventDefault()">
                                                                {{$data->percent}}% {{__('Payback')}}
                                                                @switch($data->period)
                                                                    @case(1)
                                                                    {{__('Hourly')}}
                                                                    @break
                                                                    @case(24)
                                                                    {{__('Daily')}}   @break
                                                                    @case(168)
                                                                    {{__('Weekly')}}   @break
                                                                    @case(720)
                                                                    {{__('Monthly')}}   @break
                                                                    @case(2880)
                                                                    {{__('Quarterly')}}   @break
                                                                    @case(8640)
                                                                    {{__('Yearly')}}   @break
                                                                @endswitch
                                                            </a></li>

                                                    </ul>
                                                    <a class="btn btn-plus" href="{{route('invest.index')}}"><i class="fa fa-plus"></i></a>
                                                    <a class="btn btn-white" href="{{route('invest.index')}}">{{__('Buy Now')}}</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- pricing-area end -->
    </div>



    <!-- team area start -->
    <div class="team-area-2 common-pd-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <h5 class="subtitle"><span></span>{{$general->investor_head}}</h5>
                        <h3 class="title">{{$general->investor_title}}</h3>
                        <p>{{$general->investor_description}}</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
               @foreach($investors as $data)
                <div class="col-lg-3 col-sm-6">
                    <div class="single-team-wrap text-center">
                        <div class="thumb">
                            <img src="{{asset('images/investor/'.$data->image)}}" alt="img">
                        </div>
                        <div class="team-details">
                            <h6>{{$data->name}}</h6>
                            <h6>{{$data->designation}}</h6>
                            <ul class="social-area">
                                @if(!is_null($data->fb_link))
                                <li><a href="{{$data->fb_link}}"><i class="fa fa-facebook-f"></i></a></li>
                                @endif
                                @if(!is_null($data->twitter_link))
                                <li><a href="{{$data->twitter_link}}"><i class="fa fa-twitter"></i></a></li>
                                @endif
                                @if(!is_null($data->linkedin_link))
                                <li><a href="{{$data->linkedin_link}}"><i class="fa fa-linkedin"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- team area end -->

    <!-- news-slider-area start-->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="news-slider-area">
                    <h6>{{__('Latest Top Investments News')}}</h6>
                    <div class="news-slider owl-carousel owl-theme">
                        @foreach($news as $data)
                        <div class="item"><img src="{{asset('images/news/'.$data->image)}}" alt="img"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- news-slider-area end -->

    <!-- blog-area start -->
    <div class="blog-area common-pd-bottom">
        <div class="container">
            <div class="row justify-content-center">
                @foreach($news as $data)
                <div class="col-lg-4 col-md-6">
                    <div class="single-blog-wrap">
                        <div class="thumb">
                            <img src="{{asset('images/news/'.$data->image)}}" alt="img">
                        </div>
                        <div class="blog-details">
                            <h5>{{$data->title}}</h5>
                            <span><i class="fa fa-user"></i>{{__('Author')}}</span>
                            <span><i class="fa fa-clock-o"></i>{{date('F j, Y', strtotime($data->updated_at))}}</span>
                            <p>{!! clean(short_text($data->description, 30)) !!}</p>
                            <div class="blog-btn text-center">
                                <a class="btn btn-white bottom-right-radius-0" href="{{route('single.page',['class' => 'News', 'id' =>$data->id])}}">{{__('Read More')}}<i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- blog-area end -->

    <div class="shape-5">
        <!-- client area start -->
        <div class="partner-area common-pd-bottom-4 right-bottom-line-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="partner-slider owl-carousel owl-theme">
                            @foreach($partners as $data)
                                <div class="item">
                                    <a href="#" onclick="event.preventDefault()"><img src="{{asset('images/partner/'.$data->image)}}" alt="client"></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- client area end -->
    </div>
@stop