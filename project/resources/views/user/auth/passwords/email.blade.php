@extends('front.layouts.master')
@section('title',__('Forget Password'))

@section('content')
    <div class="check-profit-area pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form method="POST" action="{{ route('user.sendResetPassMail') }}">
                        @csrf
                        <div class="title text-center">
                            <h5>{{__('Forget Password')}}</h5>
                        </div>
                        <div class="form-group">
                            <label>{{__('Your Email')}} :</label>
                            <input type="email" name="resetEmail" class="form-control" required autocomplete="resetEmail" autofocus>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">{{__('Send Password Reset Link')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
