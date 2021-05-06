@extends('admin.layouts.master')
@section('title',__('Withdraw Log'))
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th> @lang('Wd Id') </th>
                            <th> @lang('User') </th>
                            <th> @lang('Amount') </th>
                            <th> @lang('Charge') </th>
                            <th> @lang('Method') </th>
                            <th> @lang('Details') </th>
                            <th> @lang('Requested On')</th>
                            <th> @lang('Processed On')</th>
                            <th> @lang('Action')</th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach($withdraw as $key=>$data)
                            <tr class="@if($data->status == 3) danger @elseif($data->status == 1) success @else warning @endif">

                                <td >{{$data->withdraw_id}}</td>
                                <td>
                                    <p><a href="{{route('user.view', $data->user->id)}}">{{$data->user->name}}</a> </p>
                                    <p>{{$data->user->email}}</p>
                                </td>
                                <td>{{$data->amount}} {{$general->currency}}</td>
                                <td>{{$data->charge}} {{$general->currency}}</td>
                                <td>{{$data->method_name}}</td>

                                <td>
                                    <a type="button" class="btn btn-sm btn-info" href="{{route('withdraw.detail.user',$data->id)}}" >@lang('View Detail')</a>
                                </td>

                                <td>{{date('g:ia \o\n l jS F Y', strtotime($data->created_at))}}</td>
                                <td>{{date('g:ia \o\n l jS F Y', strtotime($data->updated_at))}}</td>
                                <td>
                                    @if($data->status == 3)
                                        <span class="badge badge-pill badge-danger">@lang('REFUNDED')</span>
                                    @elseif($data->status == 1)
                                        <span class="badge badge-pill badge-success"> @lang('PAID')</span>
                                    @else
                                        <span class="badge badge-pill badge-warning"> @lang('PENDING')</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{$withdraw->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection