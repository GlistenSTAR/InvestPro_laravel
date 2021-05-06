@extends('admin.layouts.master')

@section('title',__('Investors'))

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
                                <input type="text" class="form-control" name="investor_head" value="{{$general->investor_head}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label >@lang('Title Text')</label>
                                <input type="text" class="form-control" name="investor_title" value="{{$general->investor_title}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label >@lang('Description Text')</label>
                                <input type="text" class="form-control" name="investor_description" value="{{$general->investor_description}}">
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
                    <h2>@lang('Investor') <a href="{{route('investor-area.create')}}" class="btn btn-dark btn-sm float-right"><i class="fa fa-plus"></i> @lang('Add New')</a> </h2>
                </div>

                <div class="card-body table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">@lang('Image')</th>
                            <th scope="col">@lang('Name')</th>
                            <th scope="col">@lang('Designation')</th>
                            <th scope="col">@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($works as $data)
                        <tr>
                            <td>
                                <img width="50" align='middle' src="{{asset('images/investor/'.$data->image)}}" alt="your image"/>
                            </td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->designation}}</td>
                            <td>
                                <a href="{{route('investor-area.edit', $data->id)}}" class="btn btn-primary btn-sm">@lang('View/Edit')</a>
                                <a href="#delModal" data-route="{{route('investor-area.delete', $data->id)}}" data-toggle="modal" class="btn btn-danger btn-sm editButton">@lang('Delete')</a>
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
                        <h2 class="text-danger">@lang('Are you sure?')</h2>
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
