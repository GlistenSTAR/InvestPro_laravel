@extends('admin.layouts.master')

@section('title',__('Logo-icon'))

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('Logo-Icon')</h2>
                </div>

                <div class="card-body">

                    <form action="{{route('general.store')}}" method="POST" enctype="multipart/form-data">

                        @csrf


                        <div class="row">

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>@lang('Logo')</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">

                                                <input type="file" id="file-input" class="form-control" name="logo">
                                                <div class="row mt-2">
                                                    <div class="col-md-12">
                                                        <div id='img_contain'>
                                                            <img id="image-preview" class="img-fluid" align='middle' src="{{asset('images/logo/logo.png')}}" alt="your image" title=''/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>@lang('Icon')</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <input type="file" id="file-input2" class="form-control" name="favicon">
                                                <div class="row mt-2">
                                                    <div class="col-md-12">
                                                        <div id='img_contain2'>
                                                            <img id="image-preview2" class="img-fluid" align='middle' src="{{asset('images/logo/favicon.png')}}" alt="your image" title=''/>
                                                        </div>
                                                    </div>
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
