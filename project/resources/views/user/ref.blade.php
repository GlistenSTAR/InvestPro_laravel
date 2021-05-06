@extends('front.layouts.master')
@section('title',__('Referral List'))
@section('style')
    <link rel="stylesheet" href="{{asset('user/css/tree.css')}}">
@stop
@section('content')
    <!-- transaction-area start -->
    <div class="transaction-area left-bottom-line-bg common-pd-bottom-3" >
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-12">
                    <div class="transaction-tab-area">
                        <div class="transaction-table tab-content">
                            <div class="tab-pane deposit-tab fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <div class="part-text pranto-ul">
                                    <ul class="width-100">
                                        <li class="container"><h5> <span class="badge badge-primary"><strong>{{Auth::user()->name}} @lang('(me)')</strong> </span> </h5>
                                            <ul>
                                                    {!! showBelowUser(Auth::id()) !!}
                                            </ul>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- transaction-area end -->
@endsection
