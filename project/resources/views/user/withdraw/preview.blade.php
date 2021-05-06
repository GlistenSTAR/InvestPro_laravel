@extends('front.layouts.master')

@section('title', __('Withdraw Preview'))

@section('content')
    <div class="shape-2" >
        <div class="why-choose-us-area pd-bottom-85">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <form method="POST" action="{{route('confirm.withdraw.store')}}">
                            {{csrf_field()}}
                            @php
                                $charge = ((floatval($amount) * floatval($method->chargepc))/100) + floatval($amount) + floatval($method->chargefx);
                            @endphp
                            <input type="hidden" name="amount" value="{{$amount}}" >
                            <input type="hidden" name="method_id" value="{{$method->id}}" >

                            <div class="single-facility media">
                                <div class="row">
                                    <div class="col-md-4 mt-5">
                                        <div class="thumb align-self-center">
                                            <img src="{{asset('images/withdraw_methods/'.$method->image)}}" alt="icon">
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="facility-details media-body">
                                            <ul class="list-group">
                                                <li class="list-group-item">{{__('Request for Withdraw Amount')}}: <strong>{{$amount}}</strong> {{$general->currency}}</li>
                                                <li class="list-group-item text-danger">{{__('Charge')}} : <strong>{{((floatval($amount) * floatval($method->chargepc))/100)+ floatval($method->chargefx)}}</strong> {{$general->currency}} | ({{$method->chargepc}} % + {{$method->chargefx}} {{$general->currency}}) </li>
                                                <li class="list-group-item">{{__('Total Amount Deduct')}}: <strong>{{$charge}}</strong> {{$general->currency}}</li>
                                                <li class="list-group-item text-primary">{{__('In')}} {{$method->currency}}: <strong>{{round($amount*$method->rate, 4)}}</strong> {{$method->currency}}</li>
                                                <li class="list-group-item">{{__('Payment Gateway')}}: <strong>{{$method->name}}</strong> </li>
                                            </ul>

                                            <div class="panel-body table-responsive text-center">
                                                <strong class="col-md-12">{{__('INFORMATION OF WITHDRAW MONEY')}}</strong>
                                                <textarea class="form-control" name="detail" rows="5" placeholder="{{__('Provide all information')}}"></textarea>
                                            </div>

                                            <div class="btn-wrapper">
                                                <input type="submit" class="submit-btn btn-success btn-block" id="btn-confirm" value="{{__('Confirm Withdraw')}}">
                                            </div>
                                        </div>
                                    </div>

                                </div>



                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
