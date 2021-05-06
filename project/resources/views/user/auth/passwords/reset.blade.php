@extends('front.layouts.master')
@section('title',__('Reset Password'))
@section('content')
    <div class="check-profit-area pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form method="POST" action="{{route('user.resetPassword')}}">
                        @csrf
                        <input type="hidden" name="code" value="{{$code}}">
                        <input type="hidden" name="email" value="{{$email}}">
                        <div class="title text-center">
                            <h5>{{__('Reset Password')}}</h5>
                        </div>
                        <div class="form-group">
                            <label>{{__('New Password')}} :</label>
                            <input type="password" name="password" class="form-control" required autocomplete="password" autofocus>
                        </div>

                        <div class="form-group">
                            <label>{{__('Confirm Password')}} :</label>
                            <input type="password" name="password_confirmation" class="form-control" required autocomplete="password_confirmation" autofocus>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">{{__('Update Password')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
