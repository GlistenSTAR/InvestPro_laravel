@extends('admin.layouts.master')

@section('title',__('Referral'))

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('Referral Commission Settings')</h2>
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-danger font-weight-bold">@lang('NOTE : Insert "Blank or remove percentage value" for delete Level Commission.')</p>
                        </div>
                    </div>

                    <form action="{{route('admin.referral.update')}}" method="POST">
                        @csrf
                        <div class="form-row">
                            @foreach($ref as $data)
                                <div class="form-group col-md-12">
                                    <label >{{$data->id}} @lang('Level Commission')</label>
                                    <div class="input-group mb-3 ">
                                        <input type="text" class="form-control" name="percentage[]" placeholder="Commission Percentage" value="{{$data->percentage}}" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">%</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-row" id="newLevel">

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
            @if(($lastRef instanceof \App\Referral))
             var count = parseInt('{{$lastRef->id}}');
            @else
            var count = 0;
            @endif
            $("#addLevel").on('click',function() {
                count += 1;
                $("#newLevel").append(
                    `<div class="form-group col-md-12">
                        <label >`+count+` Level Commission</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="percentage[]" placeholder="Commission Percentage"  aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>
                        </div>
                    </div>`
                );
            });
        })(jQuery);
    </script>
@endsection
