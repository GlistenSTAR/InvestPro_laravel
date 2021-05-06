@extends('admin.layouts.master')

@section('title',__('Partners'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('Partners')<a href="#addModal" data-toggle="modal" class="btn btn-dark btn-sm float-right"><i class="fa fa-plus"></i> @lang('Add New')</a> </h2>
                </div>

                <div class="card-body table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">@lang('Image')</th>

                            <th scope="col">@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($works as $data)
                        <tr>
                            <td>
                                <img width="50" align='middle' src="{{asset('images/partner/'.$data->image)}}" alt="your image"/>
                            </td>
                            <td>
                                <a href="#editModal" data-toggle="modal" data-route="{{route('partner-area.update',$data->id)}}" data-image="{{asset('images/partner/'.$data->image)}}" class="btn btn-primary btn-sm editBtn">@lang('View/Edit')</a>
                                <a href="#delModal" data-route="{{route('partner-area.delete', $data->id)}}" data-toggle="modal" class="btn btn-danger btn-sm editButton">@lang('Delete')</a>
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

    <div id="addModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add Partner Logo')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form  role="form" action="{{route('partner-area.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                       <div class="form-row">
                           <div class="form-group col-md-12">
                               <label >@lang('Image') <small>@lang('(PNG format is standard)')</small></label>
                               <input type="file" id="file-input" class="form-control" name="image" required>
                               <div class="row mt-2">
                                   <div class="col-md-12">
                                       <div id='img_contain'>
                                           <img id="image-preview" class="img-fluid" align='middle' src="{{asset('images/no-image.png')}}" alt="your image" title=''/>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-success">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Edit Partner Logo')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editPartner" role="form" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label >@lang('Image') <small>@lang('(PNG format is standard)')</small></label>
                                <input type="file" id="file-input2" class="form-control" name="image" required>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div id='img_contain2'>
                                            <img id="image-preview2" class="img-fluid" align='middle' src="" alt="your image" title=''/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-success">@lang('Submit')</button>
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
        $(document).ready(function () {
            $('.editBtn').on('click',function () {
                $('#editPartner').attr('action',$(this).data('route'));
                $('#image-preview2').attr('src',$(this).data('image'));
            });
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result);
                    $('#image-preview').hide();
                    $('#image-preview').fadeIn(650);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview2').attr('src', e.target.result);
                    $('#image-preview2').hide();
                    $('#image-preview2').fadeIn(650);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#file-input").on('change',function() {
            readURL(this);
        });
        $("#file-input2").on('change',function() {
            readURL2(this);
        });
		})(jQuery);
    </script>
@endsection
