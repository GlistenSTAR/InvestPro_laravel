@extends('admin.layouts.master')

@section('title',__('Profile'))

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('Edit Profile')</h2>
                </div>

                <div class="card-body">

                    <form action="{{route('admin.updatePassword')}}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label >@lang('Name')</label>
                                <input type="text" class="form-control" name="name" value="{{auth()->guard('admin')->user()->name}}">
                            </div>

                            <div class="form-group col-md-12">
                                <label >@lang('Email')</label>
                                <input type="email" class="form-control" name="email" value="{{auth()->guard('admin')->user()->email}}">
                            </div>

                            <div class="form-group col-md-12">
                                <label>@lang('Current Password') :</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>

                            <div class="form-group col-md-12">
                                <label>@lang('New Password') :</label>
                                <input type="password" name="password" class="form-control" required >
                            </div>


                            <div class="form-group col-md-12">
                                <label>@lang('Confirm Password') :</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary mt-2">@lang('Update')</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
