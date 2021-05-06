@extends('admin.layouts.master')

@section('title',__('Banner'))

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('Banner')</h2>
                </div>

                <div class="card-body">

                    <form action="{{route('general.store')}}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label >@lang('Header Text')</label>
                                <input type="text" class="form-control" name="banner_header" value="{{$general->banner_header}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label >@lang('Body Text')</label>
                                <input type="text" class="form-control" name="banner_body" value="{{$general->banner_body}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label >@lang('Footer Text')</label>
                                <input type="text" class="form-control" name="banner_footer" value="{{$general->banner_footer}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label >@lang('Background Image') <small>@lang('(PNG format is standard)')</small></label>
                                <input type="file" id="file-input" class="form-control" name="banner_bg_image">
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div id='img_contain'>
                                            <img id="image-preview" class="img-fluid" align='middle' src="{{asset('images/banner/bg.png')}}" alt="your image" title=''/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label >@lang('Front Image') <small>@lang('(PNG format is standard)')</small></label>
                                <input type="file" id="file-input2" class="form-control" name="banner_front_image">
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div id='img_contain2'>
                                            <img id="image-preview2" class="img-fluid" align='middle' src="{{asset('images/banner/front.png')}}" alt="your image" title=''/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label >@lang('Breadcrumb Image') <small>@lang('(PNG format is standard)')</small></label>
                                <input type="file" id="file-input3" class="form-control" name="bread_front_image">
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div id='img_contain3'>
                                            <img id="image-preview3" class="img-fluid" align='middle' src="{{asset('images/banner/bred.png')}}" alt="your image" title=''/>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <button type="submit" class="btn btn-primary">@lang('Update')</button>
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

        function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview3').attr('src', e.target.result);
                    $('#image-preview3').hide();
                    $('#image-preview3').fadeIn(650);
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

        $("#file-input3").on('change',function() {
            readURL3(this);
        });
        })(jQuery);
    </script>
@endsection
