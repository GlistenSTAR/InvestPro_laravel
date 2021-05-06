@extends('front.layouts.master')

@section('title',__('News'))

@section('content')
    <!-- blog-area start -->
    <div class="blog-area">
        <div class="container">
            <div class="row justify-content-center">
              @foreach($news as $data)
                <div class="col-lg-4">
                    <div class="single-blog-wrap mg-bottom-100">
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
                  <div class="col-lg-12 text-center">
                      {{$news->links()}}
                  </div>
            </div>
        </div>
    </div>
    <!-- blog-area end -->
@stop