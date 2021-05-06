@extends('admin.layouts.master')

@section('title', __('Admin Login'))
@section('content')
    <div class="login-body">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-3 text-center">
                <h1 class="font-weight-bold mt-5"><i class="fa fa-money"></i> {{$general->web_name}}</h1>
                <p>{{$general->footer_test}}</p>
            </div>
            <div class="col-md-5">
                <div class="login_wrapper mt-0">
                    <div class="animate form login_form">
                        <section class="login_content">
                            <form method="POST" action="{{ route('admin.login') }}">
                                @csrf
                                <h2 class="mb-5 h1 text-white">@lang('Admin Login')</h2>
                                <div>
                                    <input type="email" class="form-control" placeholder="@lang('Email')" name="email" value="{{old('email')}}" required="" />
                                </div>
                                <div>
                                    <input type="password" class="form-control" placeholder="@lang('Password')" name="password" required="" />
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-success btn-block">@lang('Log in')</button>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
