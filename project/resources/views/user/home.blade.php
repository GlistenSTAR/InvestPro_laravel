@extends('front.layouts.master')
@section('title',__('Welcome In Home'))
@section('content')
    <!-- user-panel start -->
    <div class="user-panel pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="input-group mb-3">
                    <input type="text" class="form-control" id="myInputref"  value="{{url('/')}}/register/{{auth()->user()->referral_token}}">
                        <div class="input-group-append">
                            <button class="btn btn-secondary myrefButtonFunction" type="button" onclick="myrefButtonFunction()">@lang('Copy Referral Link')</button>
                        </div>
                      </div>
                </div>
                <div class="col-lg-12">
                    <div class="user-panel-wrapper">
                        <!-- user-info-area end -->
                        <div class="row statitics-item-area mb-none-30">
                            <div class="col-lg-4">
                                <div class="statitics-item mb-30">
                                    <h6 class="title">{{__('Current Balance')}}</h6>
                                    <span class="stat-amount color-1">{{round(auth()->user()->balance,8)}} {{$general->currency}}</span>
                                    <div class="item-shape-1"></div>
                                </div>
                            </div>
                            <!-- statitics-item end -->
                            <div class="col-lg-4">
                                <div class="statitics-item mb-30">
                                    <h6 class="title">{{__('Earning Total')}}</h6>
                                    <span class="stat-amount color-2">{{round($total_earn,8)}} {{$general->currency}}</span>
                                    <div class="item-shape-2"></div>
                                </div>
                            </div>
                            <!-- statitics-item end -->
                            <div class="col-lg-4">
                                <div class="statitics-item mb-30">
                                    <h6 class="title">{{__('Total Withdraw')}}</h6>
                                    <span class="stat-amount color-3">{{round($total_withdraw,8)}} {{$general->currency}}</span>
                                    <div class="item-shape-3"></div>
                                </div>
                            </div>
                            <!-- statitics-item end -->
                        </div>

                    </div>
                </div>
            </div>



            <div class="fact-count-area common-pd-bottom mt-5">
                <div class="container">
                    <div class="row justify-content-center">

                        <div class="col-lg-4 col-md-6">
                            <a href="{{route('user.deposit.log')}}">
                            <div class="single-fact-count text-center">
                                <div class="thumb">
                                    <i class="fa fa-plus font-large"></i>
                                </div>
                                <h4 class="fact-title">{{__('This Month Deposit')}}</h4>
                                <h2 class="counter">{{round($month_deposit,8)}}</h2>{{$general->currency}}
                            </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <a href="{{route('invest.log')}}">
                                <div class="single-fact-count text-center">
                                    <div class="thumb">
                                        <i class="fa fa-money font-large"></i>
                                    </div>
                                    <h4 class="fact-title">{{__('This Month Earn')}}</h4>
                                    <h2 class="counter">{{round($month_earn,8)}}</h2>{{$general->currency}}
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <a href="{{route('user.withdraw.log')}}">
                                <div class="single-fact-count text-center">
                                    <div class="thumb">
                                        <i class="fa fa-retweet font-large"></i>
                                    </div>
                                    <h4 class="fact-title">{{__('This Month Withdraw')}}</h4>
                                    <h2 class="counter">{{round($month_withdraw,8)}}</h2>{{$general->currency}}
                                </div>
                            </a>
                        </div>


                        <div class="col-lg-4 col-md-6">
                            <a href="{{route('user.withdraw.log')}}">
                                <div class="single-fact-count text-center">
                                    <div class="thumb">
                                        <i class="fa fa-spinner font-large"></i>
                                    </div>
                                    <h4 class="fact-title">{{__('Total Pending Withdraw')}}</h4>
                                    <h2 class="counter">{{round($total_PendingWithdraw,8)}}</h2>{{$general->currency}}
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <a href="{{route('transaction.log')}}">
                                <div class="single-fact-count text-center">
                                    <div class="thumb">
                                        <i class="fa fa-exchange font-large"></i>
                                    </div>
                                    <h4 class="fact-title">{{__('Total Fund Transfer')}}</h4>
                                    <h2 class="counter">{{round($total_fundTransfer,8)}}</h2>{{$general->currency}}
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <a href="{{route('transaction.log')}}">
                                <div class="single-fact-count text-center">
                                    <div class="thumb">
                                        <i class="fa fa-clock-o font-large"></i>
                                    </div>
                                    <h4 class="fact-title">{{__('This Month Fund Transfer')}}</h4>
                                    <h2 class="counter">{{round($month_fundTransfer,8)}}</h2>{{$general->currency}}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- user-panel end -->
@endsection
@section('script')
<script>
 (function($) {
    "use strict";
    $(document).ready(function () {
        $(document).on('click', '.myrefButtonFunction', function() {
            var copyText = document.getElementById("myInputref");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            alert("Copied referral link : " + copyText.value);
        })
    });
 })(jQuery);
</script>
@endsection
