@extends('admin.layouts.master')

@section('title',__('Plans'))

@section('content')
    <div class="row justify-content-center mb-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('Title & Subtitle')</h2>
                </div>

                <div class="card-body">
                    <form action="{{route('general.store')}}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label >@lang('Header Text')</label>
                                <input type="text" class="form-control" name="invest_head" value="{{$general->invest_head}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label >@lang('Title Text')</label>
                                <input type="text" class="form-control" name="invest_title" value="{{$general->invest_title}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label >@lang('Description Text')</label>
                                <input type="text" class="form-control" name="invest_description" value="{{$general->invest_description}}">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">@lang('Update')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('Plan') <a href="{{route('plan-area.create')}}" class="btn btn-dark btn-sm float-right"><i class="fa fa-plus"></i> @lang('Add New')</a> </h2>
                </div>

                <div class="card-body table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">@lang('Plan Name')</th>
                            <th scope="col">@lang('Amount')</th>
                            <th scope="col">@lang('Return Percentage')</th>
                            <th scope="col">@lang('Return Time')</th>
                            <th scope="col">@lang('Return Period')</th>
                            <th scope="col">@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($works as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>
                                @if($data->return_time_status == 1)
                                     {{$data->min_amount}} {{$general->currency}} -- {{$data->max_amount}} {{$general->currency}}
                                    @else
                                    Fixed {{$data->fixed_amount}} {{$general->currency}}
                                @endif
                            </td>
                            <td>{{$data->percent}}%</td>
                            <td>
                                @if(is_null($data->action))
                                    <span class="badge badge-success">@lang('LIFETIME')</span>
                                @else
                                    {{$data->action}} @lang('TIMES')
                                @endif
                            </td>
                            <td>
                                @switch($data->period)
                                    @case(1)
                                    @lang('Hourly')
                                    @break
                                    @case(24)
                                    @lang('Daily')   @break
                                    @case(168)
                                    @lang('Weekly')   @break
                                    @case(720)
                                    @lang('Monthly')   @break
                                    @case(2880)
                                    @lang('Quarterly')   @break
                                    @case(8640)
                                    @lang('Yearly')   @break
                                @endswitch
                            </td>
                            <td>
                                <a href="{{route('plan-area.edit', $data->id)}}" class="btn btn-primary btn-sm">@lang('View/Edit')</a>
                                <a href="#delModal" data-route="{{route('plan-area.delete', $data->id)}}" data-toggle="modal" class="btn btn-danger btn-sm editButton">@lang('Delete')</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div id="delModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Confirm Delete')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="confirmDel" role="form" action="" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <h2  class="text-danger">@lang('Are you sure?')</h2>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-danger">@lang('Delete')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script>
        (function($) {
            "use strict";
                $(document).ready(function () {
                    $('.editButton').on('click',function () {
                        $('#confirmDel').attr('action',$(this).data('route'));
                    });
                });
		})(jQuery);
    </script>
@endsection
