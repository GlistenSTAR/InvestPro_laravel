@extends('front.layouts.master')
@section('title',__('Login & Invest To Earn'))
@section('content')
    <div class="check-profit-area pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="title text-center">
                            <h5>{{__('Login to get access')}}</h5>
                        </div>
                        <div class="form-group">
                            <label>{{__('Email')}} :</label>
                            <input type="email" name="email" class="form-control" required autocomplete="email" autofocus>
                        </div>
                        <div class="form-group">
                            <label>{{__('Password')}} :</label>
                            <input type="password" name="password" class="form-control" required autocomplete="current-password">
                        </div>

                        <button type="submit" class="btn btn-success btn-block">{{__('Login')}}</button>

                        <div class="row mt-2">
                            <div class="col-md-6 mt-2">
                                <a  href="{{route('user.showEmailForm')}}">{{__('Forget Password?')}}</a>
                            </div>

                            <div class="col-md-6 mt-2">
                                <a href="{{route('register')}}">{{__('Do not have an account?')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
