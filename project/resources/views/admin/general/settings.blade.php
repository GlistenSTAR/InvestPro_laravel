@extends('admin.layouts.master')

@section('title',__('About'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('Settings')</h2>
                </div>

                <div class="card-body">

                    <form action="{{route('general.store')}}" method="POST">

                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label >@lang('Website Name')</label>
                                <input type="text" class="form-control" name="web_name" value="{{$general->web_name}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label >@lang('Website Currency (Ex: USD, EURO)')</label>
                                <input type="text" class="form-control" name="currency" value="{{$general->currency}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label >@lang('Color Code (Note: Do not use "#")')</label>
                                <input type="text" class="form-control" name="color_code" value="{{$general->color_code}}">
                            </div>

                        </div>

                        <hr>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label >@lang('Fixed Charge (Balance Transfer)')</label>
                                <input type="text" class="form-control" name="bal_trans_fixed_charge" value="{{$general->bal_trans_fixed_charge}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label >@lang('Percentage (%) Charge (Balance Transfer)')</label>
                                <input type="text" class="form-control" name="bal_trans_percentage_charge" value="{{$general->bal_trans_percentage_charge}}">
                            </div>

                        </div>
                        <hr>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label >@lang('Contact Email')</label>
                                <input type="email" class="form-control" name="contact_email" value="{{$general->contact_email}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label >@lang('Contact Phone')</label>
                                <input type="text" class="form-control" name="contact_phone" value="{{$general->contact_phone}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label >@lang('Contact Address')</label>
                                <input type="text" class="form-control" name="contact_address" value="{{$general->contact_address}}">
                            </div>
                        </div>
                        <hr>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label >@lang('CopyRight Text')</label>
                                <textarea class="form-control" name="copyright_text" id="" cols="30" rows="5">{{$general->copyright_text}}</textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label >@lang('Comment Script')</label>
                                <textarea class="form-control" name="comment_script" id="" cols="30" rows="5">{{$general->comment_script}}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">Update</button>
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
