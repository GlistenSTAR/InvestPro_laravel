@extends('admin.layouts.master')

@section('title',__('News Edit'))

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('Edit')</h2>
                </div>

                <div class="card-body">
                    <form action="{{route('news-area.update',$workArea->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label >@lang('Icon')</label>
                                <input type="file" id="file-input" class="form-control" name="image">
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div id='img_contain'>
                                            <img id="image-preview" class="img-fluid" align='middle' src="{{asset('images/news/'.$workArea->image)}}" alt="your image" title=''/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>@lang('Title')</label>
                                        <input type="text" class="form-control" name="title" value="{{$workArea->title}}" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label >@lang('Description')</label>
                                        <textarea class="form-control" name="description" rows="30" required>{!! $workArea->description !!}</textarea>
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
        (function ($) {
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
