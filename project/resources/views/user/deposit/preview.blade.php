@extends('front.layouts.master')

@section('title', __('Deposit Preview'))


@section('content')
    <div class="shape-2" >
        <div class="why-choose-us-area pd-bottom-85">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <form method="POST" action="{{route('deposit.confirm')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="gateway" value="{{$data->gateway_id}}"/>
                            @if ($data->gateway_id > 899)
                                <input type="hidden" name="depositid" value="{{$data->id}}"/>
                                <input type="hidden" name="drid" value="{{$dr->id}}"/>
                            @endif

                            <div class="single-facility media">
                                <div class="row">
                                    <div class="col-md-4 mt-5">
                                        <div class="thumb align-self-center">
                                            <img src="{{asset('images/gateway')}}/{{$data->gateway->image}}" alt="icon">
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="facility-details media-body">
                                            <h5>Amount : {{$data->amount}}
                                                <strong>{{$general->currency}}</strong></h5>

                                            <p class="list-group-item"> {{__('Charge')}} :
                                                <strong>{{$data->charge}} </strong>{{ $general->currency }}</p>
                                            <p class="list-group-item "> {{__('Payable')}} :
                                                <strong>{{$data->charge + $data->amount}} </strong>{{ $general->currency }}</p>


                                            <p class="list-group-item"> {{__('In USD')}} :
                                                <strong>${{$data->usd_amo}}</strong>
                                            </p>

                                            <div class="btn-wrapper">
                                                <input type="submit" class="submit-btn btn-success btn-block" id="btn-confirm" value="{{__('Pay Now')}}">
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
