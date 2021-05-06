@extends('admin.layouts.master')

@section('title',__('News Create'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('Create')</h2>
                </div>

                <div class="card-body">
                    <form action="{{route('plan-area.store')}}" method="POST" >
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>@lang('Plan Name')</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Plan Type')</label>
                                <select name="return_time_status" id="planType" class="form-control">
                                    <option disabled selected value="">@lang('Choose One')</option>
                                    <option value="1">@lang('ROI Invest')</option>
                                    <option value="0">@lang('Fixed Invest')</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row roiInvest">
                            <div class="form-group col-md-6">
                                <label>@lang('Minimum Amount')</label>
                                <input type="text" class="form-control" name="min_amount">
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Maximum Amount')</label>
                                <input type="text" class="form-control" name="max_amount" >
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Return Action (How many time)')</label>
                                <input type="number" class="form-control" name="action" >
                            </div>
                        </div>

                        <div class="form-row fixedInvest">
                            <div class="form-group col-md-6">
                                <label>@lang('Fixed Amount (Return Action #Liftime)')</label>
                                <input type="text" class="form-control" name="fixed_amount">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>@lang('Return Percentage')</label>
                                <input type="text" class="form-control" name="percent" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('Return Period')</label>
                                <select name="period" class="form-control" required>
                                    <option disabled selected value="">@lang('Choose One')</option>
                                    <option value="1">@lang('Hourly (1 Hour After-after)')</option>
                                    <option value="24">@lang('Daily (24 Hour After-after)')</option>
                                    <option value="168">@lang('Weekly (168 Hour After-after)')</option>
                                    <option value="720">@lang('Monthly (720 Hour After-after)')</option>
                                    <option value="2880">@lang('Quarterly (2880 Hour After-after)')</option>
                                    <option value="8640">@lang('Yearly (8640 Hour After-after)')</option>
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
    <script>
        (function($) {
            "use strict";
        $(document).ready(function () {
            $('#planType').on('change',function () {
                if (this.value == 1){
                    $('.fixedInvest').css('display','none');
                    $('.roiInvest').css('display','block');
                }
                if (this.value == 0){
                    $('.roiInvest').css('display','none');
                    $('.fixedInvest').css('display','block');
                }
            })
        })
        })(jQuery);
    </script>
@endsection
