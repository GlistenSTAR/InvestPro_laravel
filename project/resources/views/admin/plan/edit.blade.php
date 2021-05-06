@extends('admin.layouts.master')

@section('title',__('Plan Edit'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('Edit')</h2>
                </div>

                <div class="card-body">
                    <form action="{{route('plan-area.update',$workArea->id)}}" method="POST" >
                        @csrf
                        @method('put')

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>@lang('Plan Name')</label>
                                <input type="text" class="form-control" name="name" value="{{$workArea->name}}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Plan Type')</label>
                                <select name="return_time_status" id="planType" class="form-control">
                                    <option disabled  value="">@lang('Choose One')</option>
                                    <option {{$workArea->return_time_status == 1? 'selected' : ''}} value="1">@lang('ROI Invest')</option>
                                    <option {{$workArea->return_time_status == 0? 'selected' : ''}} value="0">@lang('Fixed Invest')</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row roiInvest">
                            <div class="form-group col-md-6">
                                <label>@lang('Minimum Amount')</label>
                                <input type="text" class="form-control" value="{{$workArea->min_amount}}" name="min_amount">
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Maximum Amount')</label>
                                <input type="text" class="form-control" name="max_amount" value="{{$workArea->max_amount}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Return Action (How many time)')</label>
                                <input type="number" class="form-control" name="action" value="{{$workArea->action}}">
                            </div>
                        </div>

                        <div class="form-row fixedInvest">
                            <div class="form-group col-md-6">
                                <label>@lang('Fixed Amount (Return Action #Liftime)')</label>
                                <input type="text" class="form-control" name="fixed_amount" value="{{$workArea->fixed_amount}}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>@lang('Return Percentage')</label>
                                <input type="text" class="form-control" name="percent" required value="{{$workArea->percent}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Return Period')</label>
                                <select name="period" class="form-control" required>
                                    <option disabled value="">@lang('Choose One')</option>
                                    <option  {{$workArea->period == 1? 'selected' : ''}} value="1">@lang('Hourly (1 Hour After-after)')</option>
                                    <option  {{$workArea->period == 24? 'selected' : ''}} value="24">@lang('Daily (24 Hour After-after)')</option>
                                    <option  {{$workArea->period == 168? 'selected' : ''}} value="168">@lang('Weekly (168 Hour After-after)')</option>
                                    <option  {{$workArea->period == 720? 'selected' : ''}} value="720">@lang('Monthly (720 Hour After-after)')</option>
                                    <option  {{$workArea->period == 2880? 'selected' : ''}} value="2880">@lang('Quarterly (2880 Hour After-after)')</option>
                                    <option  {{$workArea->period == 8640? 'selected' : ''}} value="8640">@lang('Yearly (8640 Hour After-after)')</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-dark mt-2">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script>
        (function($) {
            "use strict";
            $(window).load(function() {
                makeAction({{$workArea->return_time_status}});
            });
            $(document).ready(function () {
                $('#planType').on('change',function () {
                    makeAction(this.value);
                });
            });
            function makeAction(value) {
                if (value == 1){
                    $('.fixedInvest').css('display','none');
                    $('.roiInvest').css('display','block');
                }
                if (value == 0){
                    $('.roiInvest').css('display','none');
                    $('.fixedInvest').css('display','block');
                }
            }
        })(jQuery);
    </script>
@endsection
