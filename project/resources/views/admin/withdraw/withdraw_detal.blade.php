@extends('admin.layouts.master')

@section('title',__('Withdraw Detail'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('Withdraw Detail') </h2>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-6 table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <tr>
                                    <th>@lang('Title')</th>
                                    <td><b>@lang('Detail')</b></td>
                                </tr>
                                <tr>
                                    <th>@lang('Transaction'):</th>
                                    <td>{{$data->withdraw_id}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Member Name'):</th>
                                    <td><a href="{{route('user.view', $data->user->id)}}">{{$data->user->name}} </a></td>
                                </tr>

                                <tr>
                                    <th>@lang('Member Email'):</th>
                                    <td>{{$data->user->email}} </td>
                                </tr>

                                <tr>
                                    <th>@lang('Amount Of Withdraw')</th>
                                    <td>{{$data->amount}} {{$general->currency}}</td>
                                </tr>

                                <tr>
                                    <th>@lang('Charge Of Withdraw')</th>
                                    <td> {{$data->charge}} {{$general->currency}}</td>
                                </tr>

                                <tr>
                                    <th>@lang('Withdraw Method')</th>
                                    <td> <b>{{$data->method_name}} </b></td>
                                </tr>

                                <tr>
                                    <th>@lang('Given Processing Time')</th>
                                    <td> {{$data->processing_time}} Days</td>
                                </tr>

                                <tr>
                                    <th>@lang('Amount In Method Currency')</th>
                                    <td>  {{round($data->method_cur, 4)}}</td>
                                </tr>

                                <tr>
                                    <th>@lang('Date Of Create')</th>
                                    <td>  {{ date('g:ia \o\n l jS F Y', strtotime($data->created_at)) }}</td>
                                </tr>

                                <tr>
                                    <th>@lang('Detail')</th>
                                    <td> {{$data->detail }}</td>
                                </tr>

                                <tr>
                                    <th>@lang('Status')</th>
                                    <td>
                                        @if($data->status == 0)
                                            <span class="badge badge-pill badge-warning">@lang('Pending')</span>
                                        @elseif($data->status == 1)
                                            <span class="badge badge-pill badge-success">@lang('Paid')</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">@lang('Refunded')</span>
                                        @endif
                                    </td>
                                </tr>

                            </table>

                            <p class="text-danger">@lang('Charge Already taken. Send') {{floatval($data->amount) * floatval($data->method_rate) }} {{$data->method_cur}} @lang('To The User')</p>

                        </div>

                        @if($data->status == 0)
                        <div class="col-md-6">
                            <form method="post" action="{{route('withdraw.process', $data->id)}}">
                                {{csrf_field()}}
                            <div class="card">
                                <div class="card-body">
                                   <div class="row">
                                       <div class="form-group col-12">
                                           <strong >@lang('Message')</strong>
                                           <textarea class="form-control" name="message" rows="5"></textarea>
                                       </div>
                                   </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" name="status" value="1" class="btn btn-sm btn-success pull-left">@lang('Processed')</button>
                                    <button type="submit" name="status"  value="3" class="btn btn-sm btn-danger pull-right">@lang('Refund')</button>
                                </div>

                            </div>
                            </form>
                        </div>
                        @endif
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