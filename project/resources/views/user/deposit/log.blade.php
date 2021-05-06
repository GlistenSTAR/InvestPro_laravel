@extends('front.layouts.master')
@section('title',__('Deposit History'))
@section('content')
    <!-- transaction-area start -->
    <div class="transaction-area left-bottom-line-bg common-pd-bottom-3" >
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-12">
                    <div class="transaction-tab-area">

                        <div class="transaction-table tab-content">
                            <div class="tab-pane deposit-tab fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">{{__('Gateway Name')}}</th>
                                            <th scope="col">{{__('Amount')}}</th>
                                            <th scope="col">{{__('Charge')}}</th>
                                            <th scope="col">{{__('USD Amount')}}</th>
                                            <th scope="col">{{__('Status')}}</th>
                                            <th scope="col">{{__('Transaction ID')}}</th>
                                            <th scope="col">{{__('Time')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($deposits as $deposit)
                                        <tr class="table-margin">
                                            <th></th>
                                        </tr>

                                        <tr>
                                            <td data-label="Email">{{($deposit->gateway->main_name)?$deposit->gateway->main_name:$deposit->gateway->name}}</td>
                                            <td data-label="Username">{{round($deposit->amount, 8)}} {{$general->currency}}</td>
                                            <td data-label="Mobile">{{round($deposit->charge, 8)}} {{$general->currency}}</td>
                                            <td data-label="Balance">{{round($deposit->usd_amo, 8)}} {{__('USD')}}</td>
                                            @if(isset($deposit->deposit_request_table) && !is_null($deposit->deposit_request_table))
                                                @if($deposit->deposit_request_table->accepted == 0)
                                                    <td data-label="Balance">{{__('pending')}}</td>
                                                    @elseif($deposit->deposit_request_table->accepted == 1)
                                                    <td data-label="Balance">{{__('complete')}}</td>
                                                    @else
                                                    <td data-label="Balance">{{__('rejected')}}</td>
                                                    @endif
                                                @else
                                                <td data-label="Balance">{{($deposit->status==0)?'incomplete':'complete'}}</td>
                                            @endif
                                            <td  data-label="Details">{{$deposit->trx}}</td>
                                            <td  data-label="Time">{{$deposit->updated_at->format('d/m/y  h:i A')}}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            {{$deposits->links()}}
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
    <!-- transaction-area end -->
@endsection
