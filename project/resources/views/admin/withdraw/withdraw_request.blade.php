@extends('admin.layouts.master')
@section('title',__('Withdraw Request'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('Withdraw Requests')  </h2>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>@lang('Withdraw Id')</th>
                            <th>@lang('Member Name')</th>
                            <th>@lang('Amount Of Withdraw')</th>
                            <th>@lang('Method')</th>
                            <th>@lang('Amount In Method')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($withdraw as $key=> $data)
                            <tr id="row1">
                                <td> <b>{{$data->withdraw_id}}</b></td>
                                <td> {{optional($data->user)->name}}</td>
                                <td> {{$data->amount}} {{$general->currency}}</td>
                                <td><b>{{$data->method_name}} </b></td>
                                <td> {{round(floatval($data->amount)*floatval($data->method_rate), 4)}} {{$data->method_cur}}</td>
                                <td>@if($data->status == 0)
                                        <span class="badge badge-pill badge-warning text-dark">@lang('Pending')</span>
                                    @elseif($data->status == 1)
                                        <span class="badge badge-pill badge-success text-dark" >@lang('Paid')</span>
                                    @else
                                        <span class="badge badge-pill badge-danger text-dark">@lang('Refunded')</span>
                                    @endif
                                </td>
                                <td><a class="btn btn-sm btn-primary" href="{{route('withdraw.detail.user', $data->id)}}">@lang('Action')</a></td>
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
@section('script')
    <script>
        (function($) {
            "use strict";
        $(document).ready(function() {
            function disableBack() { window.history.forward() }

            window.onload = disableBack();
            window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
        });
        })(jQuery);
    </script>
@endsection