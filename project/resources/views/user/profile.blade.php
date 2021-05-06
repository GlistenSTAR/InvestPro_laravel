@extends('front.layouts.master')
@section('title',__('Edit Your Profile'))
@section('content')
    <div class="check-profit-area pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf

                        <div class="title text-center">
                            <h5>{{__('Update Profile')}}</h5>
                        </div>
                        <div class="form-group">
                            <label>{{__('Name')}}</label>
                            <input class="form-control" name="name" value="{{$user->name}}" type="text">
                        </div>

                        <div class="form-group">
                            <label>{{__('Mobile')}}</label>
                            <input class="form-control" name="mobile" value="{{$user->mobile}}" type="text">
                        </div>

                        <div class="form-group">
                            <label>{{__('Gender')}}</label>
                            <select name="gender" class="form-control">
                                <option {{$user->gender == 1? 'selected':''}} value="1">{{__('Men')}}</option>
                                <option {{$user->gender == 0? 'selected':''}} value="0">{{__('Female')}}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>{{__('Address')}}</label>
                            <input class="form-control" name="address" value="{{$user->address}}" type="text">
                        </div>

                        <div class="form-group">
                            <label>{{__('Zip-Code')}}</label>
                            <input class="form-control" name="zip_code" value="{{$user->zip_code}}" type="text">
                        </div>

                        <div class="form-group">
                            <label>{{__('City')}}</label>
                            <input class="form-control" name="city" value="{{$user->city}}" type="text">
                        </div>

                        <div class="form-group autocomplete">
                            <label>{{__('Country')}}</label>
                            <input class="form-control" id="myInput" name="country" value="{{$user->country}}" type="text" autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-success btn-block">{{__('Submit')}}</button>
                    </form>
                </div>

                <div class="col-lg-6">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <div class="title text-center">
                            <h5>{{__('Change Password')}}</h5>
                        </div>
                        <div class="form-group">
                            <label>{{__('Current Password')}} :</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>{{__('New Password')}} :</label>
                            <input type="password" name="password" class="form-control" required >
                        </div>
                        <div class="form-group">
                            <label>{{__('Confirm Password')}} :</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">{{__('Submit')}}</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('user/js/countryWiseCity.js')}}"></script>
@endsection
