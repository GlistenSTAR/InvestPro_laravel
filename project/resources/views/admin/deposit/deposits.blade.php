@extends('admin.layouts.master')

@section('title',__('Deposit Log'))

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>
                        @lang('Deposit Log')
                    </h2>
                </div>

                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('Serial')</th>
                            <th scope="col">@lang('Name')</th>
                            <th scope="col">@lang('Gateway Name')</th>
                            <th scope="col">@lang('Amount')</th>
                            <th scope="col">@lang('Charge')</th>
                            <th scope="col">@lang('USD Amount')</th>
                            <th scope="col">@lang('Status')</th>
                            <th scope="col">@lang('Transaction ID')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($deposits as $deposit)
                            <tr>
                                <td>{{++$i}}</td>
                                <td data-label="Name"><a target="_blank" href="{{route('user.view', $deposit->user_id)}}">{{$deposit->user->name}}</a></td>
                                <td data-label="Email">{{($deposit->gateway->main_name)?$deposit->gateway->main_name:$deposit->gateway->name}}</td>
                                <td data-label="Username">{{round($deposit->amount, 8)}} {{$general->currency}}</td>
                                <td data-label="Mobile">{{round($deposit->charge, 8)}} {{$general->currency}}</td>
                                <td data-label="Balance">{{round($deposit->usd_amo, 8)}} USD</td>
                                <td>
                                @if(isset($deposit->deposit_request_table) && !is_null($deposit->deposit_request_table))
                                    @if($deposit->deposit_request_table->accepted == 0)
                                        <span class="badge badge-warning">@lang('pending')</span>
                                    @elseif($deposit->deposit_request_table->accepted == 1)
                                        <span class="badge badge-success">@lang('approved')</span>
                                    @else
                                        <span class="badge badge-danger">@lang('rejected')</span>
                                    @endif
                                @else
                                    <span class="badge badge-info">{{($deposit->status==0)?'incomplete':'complete'}}</span>
                                @endif
                                </td>
                                <td  data-label="Details">{{$deposit->trx}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$deposits->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection

