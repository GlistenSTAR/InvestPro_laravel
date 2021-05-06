@extends('front.layouts.master')

@section('title',__('Contact'))

@section('content')
    <!-- contact area start -->
    <div class="contact-area pd-bottom-85">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <h5 class="subtitle">{{__('Feel Free To Contact Us')}}</h5>
                        <h3 class="title">{{__('Contact Us')}}</h3>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="single-contact text-center bottom-left-radius-0">
                        <div class="icon">
                            <img src="{{asset('images/contact/home.png')}}" alt="icon">
                        </div>
                        <h5>{{__('Our Head Office')}}</h5>
                        <p>{!! clean($general->contact_address) !!}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-contact text-center bottom-left-radius-0">
                        <div class="icon">
                            <img src="{{asset('images/contact/envelope.png')}}" alt="icon">
                        </div>
                        <h5>{{__('E-mail')}}</h5>
                        <p>{!! clean($general->contact_email) !!}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-contact text-center bottom-left-radius-0">
                        <div class="icon">
                            <img src="{{asset('images/contact/phone.png')}}" alt="icon">
                        </div>
                        <h5>{{__('Phone')}}</h5>
                        <p>{!! clean($general->contact_phone) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact area end -->
@stop