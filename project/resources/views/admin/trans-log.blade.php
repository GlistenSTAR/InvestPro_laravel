@extends('admin.layouts.master')

@section('title',__('Transaction'))

@section('content')
    <div class="row justify-content-center mb-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('Search from log')</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('search.trans.admin')}}" method="Get">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <input type="text" class="form-control" placeholder="Search Via Trans ID" name="trans_id" value="{{isset(request()->trans_id) ? request()->trans_id: '' }}">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" class="form-control" placeholder="Search Via User's name" name="user" value="{{isset(request()->user) ? request()->user: '' }}">
                            </div>
                            <div class="form-group col-md-3">
                                <select class="form-control" name="type">
                                    <option {{isset(request()->type) && (request()->type == 'All') ? 'selected': '' }} value="All">@lang('All')</option>
                                    <option {{isset(request()->type) && (request()->type == 'Invest') ? 'selected': '' }} value="Invest">@lang('Invest')</option>
                                    <option {{isset(request()->type) && (request()->type == 'Deposit') ? 'selected': '' }} value="Deposit">@lang('Deposit')</option>
                                    <option {{isset(request()->type) && (request()->type == 'Transfer') ? 'selected': '' }} value="Transfer">@lang('Transfer')</option>
                                    <option {{isset(request()->type) && (request()->type == 'Income') ? 'selected': '' }} value="Income">@lang('Income')</option>
                                    <option {{isset(request()->type) && (request()->type == 'Withdraw') ? 'selected': '' }} value="Withdraw">@lang('Withdraw')</option>
                                    <option {{isset(request()->type) && (request()->type == 'Referral') ? 'selected': '' }} value="Referral">{{__('Referral')}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-primary btn-block"> <i class="fa fa-search"></i> @lang('Search')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><i class="fa fa-user"></i> @lang('Transaction List')</div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th> @lang('Trans ID') </th>
                                <th> @lang('User') </th>
                                <th> @lang('Details') </th>
                                <th> @lang('Amount') </th>
                                <th> @lang('Old Balance') </th>
                                <th> @lang('New Balance') </th>
                                <th> @lang('Type') </th>
                                <th> @lang('Time') </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trans as $key => $data)
                                <tr>
                                    <td>{{$data->trans_id}}</td>
                                    <td><a href="{{route('user.view', $data->user->id)}}">{{$data->user->name}}</a></td>
                                    <td>{{$data->description}}</td>
                                    <td>{{round($data->amount,8)}} {{$general->currency}}</td>
                                    <td>{{round($data->old_bal,8)}} {{$general->currency}}</td>
                                    <td>{{round($data->new_bal,8)}} {{$general->currency}}</td>
                                    <td>
                                        @if($data->status == 0)
                                            <span class="badge badge-primary">@lang('Invest')</span>
                                        @elseif($data->status == 1)
                                            <span class="badge badge-success">@lang('Deposit')</span>
                                        @elseif($data->status == 2)
                                            <span class="badge badge-info">@lang('Transfer')</span>
                                        @elseif($data->status == 3)
                                            <span class="badge badge-dark">@lang('Withdraw')</span>
                                        @elseif($data->status == 5)
                                        <span class="badge badge-secondary">{{__('Referral Commission')}}</span>
                                       
                                        @else
                                            <span class="badge badge-warning">@lang('Income')</span>
                                        @endif
                                    </td>
                                    <td>{{date('d/m/y  h:i A',strtotime($data->created_at))}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-12 text-center">{{$trans->links()}}</div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection

