@extends('admin.layouts.master')

@section('title','| Service Create')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Create</h2>
                </div>

                <div class="card-body">
                    <form action="{{route('service-area.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label >Icon <small>(PNG format is standard)</small></label>
                                <input type="file" id="file-input" class="form-control" name="icon" required>
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
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label >Description</label>
                                        <textarea class="form-control" name="description" rows="10" required></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-dark mt-2">Submit</button>
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
