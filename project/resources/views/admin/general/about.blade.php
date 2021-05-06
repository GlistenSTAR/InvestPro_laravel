@extends('admin.layouts.master')

@section('title',__('About'))

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('About')</h2>
                </div>

                <div class="card-body">

                    <form action="{{route('general.store')}}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label >@lang('Header Text')</label>
                                <input type="text" class="form-control" name="about_head" value="{{$general->about_head}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label >@lang('Title Text')</label>
                                <input type="text" class="form-control" name="about_title" value="{{$general->about_title}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label >@lang('Video URL')</label>
                                <input type="text" class="form-control" name="about_video_url" value="{{$general->about_video_url}}">
                            </div>

                            <div class="form-group col-md-12">
                                <label >@lang('Body Text')</label>
                                <textarea class="form-control" name="about_body" id="" cols="30" rows="10">{{$general->about_body}}</textarea>
                            </div>


                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>@lang('Content One')</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label >@lang('Background Image') <small>@lang('(PNG format is standard)')</small></label>
                                                <input type="file" id="file-input" class="form-control" name="single_about1_icon">
                                                <div class="row mt-2">
                                                    <div class="col-md-12">
                                                        <div id='img_contain'>
                                                            <img id="image-preview" class="img-fluid" align='middle' src="{{asset('images/about/one.png')}}" alt="your image" title=''/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label >@lang('Content One Title')</label>
                                                    <input type="text" class="form-control" name="single_about1_title" value="{{$general->single_about1_title}}">
                                                </div>

                                                <div class="form-group">
                                                    <label >@lang('Content One Description')</label>
                                                    <textarea class="form-control" name="single_about1_description" id="" cols="30" rows="10">{{$general->single_about1_description}}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>@lang('Content Two')</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label >@lang('Front Image') <small>@lang('(PNG format is standard)')</small></label>
                                                <input type="file" id="file-input2" class="form-control" name="single_about2_icon">
                                                <div class="row mt-2">
                                                    <div class="col-md-12">
                                                        <div id='img_contain2'>
                                                            <img id="image-preview2" class="img-fluid" align='middle' src="{{asset('images/about/two.png')}}" alt="your image" title=''/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label >@lang('Content Two Title')</label>
                                                    <input type="text" class="form-control" name="single_about2_title" value="{{$general->single_about2_title}}">
                                                </div>

                                                <div class="form-group">
                                                    <label >@lang('Content Two Description')</label>
                                                    <textarea class="form-control" name="single_about2_description" id="" cols="30" rows="10">{{$general->single_about2_description}}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary mt-2">@lang('Update')</button>
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
