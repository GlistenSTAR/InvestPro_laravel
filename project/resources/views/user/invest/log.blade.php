@extends('front.layouts.master')
@section('title',__('Invest History'))
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
                                            <th> {{__('Package')}} </th>
                                            <th> {{__('Type')}} </th>
                                            <th> {{__('Invest Amount')}} </th>
                                            <th> {{__('Payable')}} </th>
                                            <th> {{__('Already Return')}} </th>
                                            <th> {{__('Next Return Time')}} </th>
                                            <th> {{__('Status')}} </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($plans as $data)
                                        <tr class="table-margin">
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>{{$data->plan_name}}</td>
                                            <td>
                                                @switch($data->get_period)
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
                                            </td>
                                            <td>{{$data->invest_amount}}  {{$general->currency}}</td>
                                            <td>{{$data->get_percent}}%/{{is_null($data->get_action) ? 'Lifetime': $data->get_action.' Times'}}  </td>
                                            <td>{{$data->took_action}} {{__('TIMES')}}</td>
                                            <td>{{date('d/m/y  h:i A',strtotime($data->next_time))}}</td>
                                            <td>
                                                @if($data->status == 0)
                                                    <span class="badge badge-primary">{{__('Continue')}}</span>
                                                @else
                                                    <span class="badge badge-success">{{__('Complete')}}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            {{$plans->links()}}
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
