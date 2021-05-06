@extends('front.layouts.master')

@section('title',isset($title) ? $title: 'Single Page')

@section('content')
    <!-- blog details area start  -->
    <div class="blog-details-area mg-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div class="blog-details-content">
                        <!-- blog details content  -->
                        @isset($image)
                        <div class="thumb">
                            <img class="w-100" src="{{$image}}" alt="Title">
                        </div>
                        @endif

                        <div class="common_area">
                            @isset($updated_at)
                            <div class="date">
                                <span>{{date('d',strtotime($updated_at))}}</span>
                                <p>{{date('M',strtotime($updated_at))}}</p>
                            </div>
                            @endif
                        </div>
                        <div class="content">
                           
                                @isset($description)
                            <p>{!! clean(nl2br($description)) !!} </p>
                                @endif
                        </div>
                        <div class="entry-footer">

                            <div class="right-content">
                                <ul class="footer-social">
                                    <li class="title">{{__('Share')}}:</li>
                                    <li>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current()) }}" target="_blank" class="facebook"> <i class="fa fa-facebook-f" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a href="https://twitter.com/intent/tweet?text=my share text&amp;url={{urlencode(url()->current()) }}" target="_blank" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{urlencode(url()->current()) }}&amp;title=my share text&amp;summary=dit is de linkedin summary" target="_blank" class="linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    <li><a href="https://plus.google.com/share?url={{urlencode(url()->current()) }}" target="_blank" class="google"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="comments">
                                        <div id="fb-root"></div>
                                        <script>(function(d, s, id) {
                                                var js, fjs = d.getElementsByTagName(s)[0];
                                                if (d.getElementById(id)) return;
                                                js = d.createElement(s); js.id = id;
                                                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1421567158073949";
                                                fjs.parentNode.insertBefore(js, fjs);
                                            }(document, 'script', 'facebook-jssdk'));
                                        </script>
                                        <div class="fb-comments" data-href="{{ url()->current() }}" data-width="100%" data-numposts="5"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- //. entry footer -->

                    </div>
                    <!-- //. blog details content -->
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="sidebar">
                        <div class="widget social_share">
                            <h5 class="widgettitle"><span>{{__('Follow Us')}}</span></h5>
                            <ul class="social-link">
                                @foreach($social as $data)
                                    <li><a href="{{$data->link}}" target="_blank" class="{{$data->icon}}"><i class="fa fa-{{$data->icon}}" aria-hidden="true"></i></a></li>
                                @endforeach
                            </ul>
                            <!-- /.social-box -->
                        </div>

                        <div class="widget widget-popular-post">
                            <h5 class="widgettitle">
                                <span>{{__('Recent Posts')}}</span>
                            </h5>

                            @foreach($recentPost as $data)
                            <div class="single-post">
                                <div class="part-img">
                                    <img src="{{asset('images/news/'.$data->image)}}" alt="">
                                </div>
                                <div class="part-text">
                                    <span>{{date('M d, Y',strtotime($data->updated_at))}} </span>
                                    <h4><a href="{{route('single.page',['class' => 'News','id'=>$data->id])}}"> {{short_text($data->title,5)}} </a></h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- blog details area end  -->

@stop