@extends('front.layouts.master')
@section('title',__('Transactions'))
@section('content')
    <!-- transaction-area start -->
    <div class="transaction-area left-bottom-line-bg common-pd-bottom-3" >
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <form action="{{route('search.trans.user')}}" method="Get">
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <input type="text" class="form-control" placeholder="Search Via Trans ID" name="trans_id" value="{{isset(request()->trans_id) ? request()->trans_id: '' }}">
                            </div>
                            <div class="form-group col-md-5">
                                <select class="form-control" name="type">
                                    <option {{isset(request()->type) && (request()->type == 'All') ? 'selected': '' }} value="All">{{__('All Transactions')}}</option>
                                    <option {{isset(request()->type) && (request()->type == 'Invest') ? 'selected': '' }} value="Invest">{{__('Invest')}}</option>
                                    <option {{isset(request()->type) && (request()->type == 'Deposit') ? 'selected': '' }} value="Deposit">{{__('Deposit')}}</option>
                                    <option {{isset(request()->type) && (request()->type == 'Transfer') ? 'selected': '' }} value="Transfer">{{__('Transfer')}}</option>
                                    <option {{isset(request()->type) && (request()->type == 'Income') ? 'selected': '' }} value="Income">{{__('Income')}}</option>
                                    <option {{isset(request()->type) && (request()->type == 'Withdraw') ? 'selected': '' }} value="Withdraw">{{__('Withdraw')}}</option>
                                    <option {{isset(request()->type) && (request()->type == 'Referral') ? 'selected': '' }} value="Referral">{{__('Referral')}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <button type="submit" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12">
                    <div class="transaction-tab-area">
                        <div class="transaction-table tab-content">
                            <div class="tab-pane deposit-tab fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th> {{__('Trans ID')}} </th>
                                            <th> {{__('Details')}} </th>
                                            <th> {{__('Amount')}} </th>
                                            <th> {{__('Old Balance')}} </th>
                                            <th> {{__('New Balance')}} </th>
                                            <th> {{__('Type')}} </th>
                                            <th> {{__('Time')}} </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($trans as $data)
                                        <tr class="table-margin">
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>{{$data->trans_id}}</td>
                                            <td>{{$data->description}}</td>
                                            <td>{{round($data->amount,8)}}{{$general->currency}}</td>
                                            <td>{{round($data->old_bal,8)}}{{$general->currency}}</td>
                                            <td>{{round($data->new_bal,8)}}{{$general->currency}}</td>
                                            <td>
                                                @if($data->status == 0)
                                                    <span class="badge badge-primary">{{__('Invest')}}</span>
                                                @elseif($data->status == 1)
                                                    <span class="badge badge-success">{{__('Deposit')}}</span>
                                                @elseif($data->status == 2)
                                                    <span class="badge badge-info">{{__('Transfer')}}</span>
                                                @elseif($data->status == 3)
                                                    <span class="badge badge-dark">{{__('Withdraw')}}</span>
                                                @elseif($data->status == 5)
                                                <span class="badge badge-secondary">{{__('Referral Commission')}}</span>
                                                @else
                                                    <span class="badge badge-warning">{{__('Income')}}</span>
                                                @endif
                                            </td>
                                            <td>{{date('d/m/y  h:i A',strtotime($data->created_at))}}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            {{$trans->links()}}
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
