@extends('front.layouts.master')
@section('title',__('Plan'))
@section('content')
    <!-- user-panel start -->
    <div class="user-panel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pricing-area pd-bottom-85">
                        <div class="container">
                            <div class="row justify-content-start">

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
                                                                <a class="btn btn-plus investRoi" data-all="{{$data}}" data-route="{{route('purchase.plan',$data->id)}}"  href="#addModal" data-toggle="modal"><i class="fa fa-plus"></i></a>
                                                                <a class="btn btn-white investRoi" data-all="{{$data}}" data-route="{{route('purchase.plan',$data->id)}}" href="#addModal" data-toggle="modal">{{__('Buy Now')}}</a>
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
                                                                <a class="btn btn-plus investFixed" href="#addModalTwo" data-toggle="modal" data-all="{{$data}}"  data-route="{{route('purchase.plan',$data->id)}}"><i class="fa fa-plus"></i></a>
                                                                <a class="btn btn-white investFixed" href="#addModalTwo" data-toggle="modal" data-all="{{$data}}"  data-route="{{route('purchase.plan',$data->id)}}">{{__('Buy Now')}}</a>
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
                </div>
            </div>
        </div>
    </div>
    <!-- user-panel end -->

    <div id="addModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title roiTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="purPlan" action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <h6 class="text-success text-center totalGetAmount"></h6>
                        <p class="text-primary text-center roiMsg"></p>
                        <div class="form-row">
                            <div class="input-group col-md-12">
                                <input type="text" class="form-control" id="investAmount" name="invest_amount" placeholder="{{__('Put Amount for invest')}}" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">{{$general->currency}}</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-danger text-center roiMinMax"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-success submitBtn">{{__('Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="addModalTwo" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fixTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="purPlanTwo" action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <h6 class="text-danger text-center tAmountFix"></h6>
                        <h5 class="text-success text-center totalGetAmountFix"></h5>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-success">{{__('Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function($) {
            "use strict";
        $(document).ready(function () {
            $('.submitBtn').css('display','none');
            $('.investFixed').on('click',function () {
                $('#purPlanTwo').attr('action',$(this).data('route'));
                let retuenPerFix = $(this).data('all')['percent'];
                let amtFix = $(this).data('all')['fixed_amount'];
                $('.fixTitle').text($(this).data('all')['name']);
                $('.tAmountFix').text(amtFix+' {{$general->currency}} will deduct from your balance');
                $('.totalGetAmountFix').text('You will get '+retuenPerFix+'% of your Invest for Lifetime');
            });

            $('.investRoi').on('click',function () {
                $('#purPlan').attr('action',$(this).data('route'));
                $('#investAmount').val('');
                getBlank();
                let minAmount = $(this).data('all')['min_amount'];
                let maxAmount = $(this).data('all')['max_amount'];
                let retuenPer = $(this).data('all')['percent'];
                let retuenAction = $(this).data('all')['action'];
                $('.roiTitle').text($(this).data('all')['name']);
                $('.roiMinMax').text('Minimum '+minAmount+' {{$general->currency}} - Maximum '+maxAmount+'{{$general->currency}}');
                $('#investAmount').on('keyup',function () {
                    let invAmount = this.value;
                    if ((parseFloat(invAmount) >= parseFloat(minAmount)) && (parseFloat(invAmount) <= parseFloat(maxAmount))) {
                        let returnAmt = (parseFloat(invAmount)*parseFloat(retuenPer))/100;
                        let totalGetAmount = parseFloat(returnAmt)*parseFloat(retuenAction);
                        $('.roiMsg').text('You will get '+returnAmt+' {{$general->currency}} for '+retuenAction+' times');
                        $('.totalGetAmount').text('You will get total '+totalGetAmount+' {{$general->currency}} after complete ROI');
                        $('.submitBtn').css('display','block');
                    }else {
                        $('.submitBtn').css('display','none');
                        getBlank();
                    }
                })
            });
            function getBlank() {
                $('.roiMsg').text('');
                $('.totalGetAmount').text('');
            }
        });
        })(jQuery);
    </script>
@endsection
