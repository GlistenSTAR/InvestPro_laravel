@extends('admin.layouts.master')

@section('title',__('Investor Create'))

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('Create')</h2>
                </div>

                <div class="card-body">
                    <form action="{{route('investor-area.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
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

                            <div class="form-group col-md-6">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>@lang('Name')</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>@lang('Designation')</label>
                                        <input type="text" class="form-control" name="designation" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>@lang('Facebook Profile Link (If Have)')</label>
                                        <input type="text" class="form-control" name="fb_link">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>@lang('Twitter Profile Link (If Have)')</label>
                                        <input type="text" class="form-control" name="twitter_link">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>@lang('Linkedin Profile Link (If Have)')</label>
                                        <input type="text" class="form-control" name="linkedin_link">
                                    </div>

                                </div>
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

            $("#file-input").on('change',function() {
                readURL(this);
            });
        })(jQuery);
    </script>
@endsection
