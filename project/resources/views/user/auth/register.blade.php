@extends('front.layouts.master')
@section('title',__('Register From Here'))

@section('content')
    <div class="check-profit-area pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="title text-center">
                            <h5>{{__('Register & Get Start the Journey')}}</h5>
                        </div>
                        @isset($refName)
                        <div class="form-group">
                            <label>{{__('Referrer Name')}} :</label>
                            <input type="text" disabled class="form-control" value="{{$refName->name}}">
                        </div>
                        <input type="hidden" value="{{$refName->id}}" name="ref_id">
                        @endisset

                        <div class="form-group">
                            <label>{{__('Full Name')}} :</label>
                            <input type="text" name="name" class="form-control" required value="{{old('name')}}" autocomplete="name" autofocus>
                        </div>
                        <div class="form-group">
                            <label>{{__('Email')}} :</label>
                            <input type="email" name="email" class="form-control" required autocomplete="email" value="{{old('email')}}" autofocus>
                        </div>
                        <div class="form-group">
                            <label>{{__('Password')}} :</label>
                            <input type="password" name="password" class="form-control" required >
                        </div>
                        <div class="form-group">
                            <label>{{__('Confirm Password')}} :</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">{{__('Register')}}</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
