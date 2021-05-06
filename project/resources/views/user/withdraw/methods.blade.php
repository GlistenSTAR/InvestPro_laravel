@extends('front.layouts.master')

@section('title', __('Payment Methods'))

@section('content')
    <div class="video-area-2 common-pd-bottom right-line-bg">
        <div class="container">
            <div class="row">
                @foreach($gateways as $gate)
                    <div class="col-lg-3 col-md-6">
                        <div class="single-about text-center bg-gradient">
                            <div class="thumb">
                                <img src="{{asset('images/withdraw_methods')}}/{{$gate->image}}" alt="icon">
                            </div>
                            <h5><a href="#depositModal{{$gate->id}}" data-toggle="modal">{{$gate->name}}</a></h5>
                            <a class="btn btn-plus" href="#depositModal{{$gate->id}}" data-toggle="modal"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="depositModal{{$gate->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{__('Withdraw via')}} <strong>{{$gate->name}}</strong></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="{{route('withdraw.preview.user')}}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="modal-body">
                                        <p class="text-danger">{{__('Charge for withdraw Amount')}}: {{$gate->chargefx}} {{$general->currency}}</p>
                                        <p>{{__('Percentage Charge')}}: {{$gate->chargepc}} %</p>
                                        <p class="text-danger">{{__('Processing Days (At last)')}} : {{$gate->processing_day}} {{__('Days')}}</p>
                                        <p class="text-success"> {{__('Minimum')}} {{$gate->min_amo}}{{$general->currency}} & {{__('Maximum')}} {{$gate->max_amo}} {{$general->currency}}</p>
                                        <hr/>
                                        <input type="hidden" name="gateway" value="{{$gate->id}}">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" name="amount" class="form-control" id="amount" placeholder="{{__('AMOUNT YOU WANT TO WITHDRAW')}}" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">{{$general->currency}}</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success ">{{__('Preview')}}</button>
                                        <button type="button" class="btn btn-danger " data-dismiss="modal">{{__('Close')}}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
