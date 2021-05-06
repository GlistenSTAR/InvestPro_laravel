@extends('admin.layouts.master')

@section('title','| '.$user->name)

@section('content')
    <div class="row">

        <div class="col-md-4">
            <div class="card mb-5">
                <div class="card-header">
                    <div class="card-title"><i class="fa fa-user"></i> @lang('PROFILE') </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="bold">{{$user->name}} </h2>
                            <h4>{{$user->email}} </h4>
                        </div><hr>
                        <div class="col-md-12">
                            <h3 class="bold">@lang('BALANCE') : {{$user->balance}} {{$general->currency}}</h3>
                            <p class="bold">@lang('Joined') {{$user->created_at->format('d/m/y  h:i A')}}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-5">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fa fa-cogs e6fffa"></i> @lang('Operations') </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 uppercase">
                                    <a href="{{route('add.subs.index', $user->id)}}" class="btn btn-primary btn-block"> <i class="fas fa-money-bill-alt"></i> @lang('Add / Deduct balance')  </a>
                                </div>

                                <div class="col-md-6 uppercase">
                                    <a href="{{route('user.mail.send', $user->id)}}" class="btn btn-info  btn-block"> <i class="fa fa-envelope"></i> @lang('Send Email')  </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card mb-5">
                        <div class="card-header">
                            <div class="card-title"><i class="fa fa-cog"></i> @lang('Update Profile') </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('user.detail.update', $user->id)}}" method="post">
                                {{csrf_field()}}
                                {{method_field('put')}}

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <strong>@lang('Name')</strong>
                                        <input class="form-control" name="name" value="{{$user->name}}" type="text">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <strong>@lang('Mobile')</strong>
                                        <input class="form-control" name="mobile" value="{{$user->mobile}}" type="text">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <strong>@lang('Gender')</strong>
                                        <select name="gender" class="form-control">
                                            <option {{$user->gender == 1? 'selected':''}} value="1">@lang('Men')</option>
                                            <option {{$user->gender == 0? 'selected':''}} value="0">@lang('Female')</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <strong>@lang('Address')</strong>
                                        <input class="form-control" name="address" value="{{$user->address}}" type="text">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <strong>@lang('Zip-Code')</strong>
                                        <input class="form-control" name="zip_code" value="{{$user->zip_code}}" type="text">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <strong>@lang('City')</strong>
                                        <input class="form-control" name="city" value="{{$user->city}}" type="text">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <strong>@lang('Country')</strong>
                                        <input class="form-control" name="country" value="{{$user->country}}" type="text">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <strong>@lang('Status')</strong>
                                        <select name="status" class="form-control">
                                            <option {{$user->status == 1? 'selected':''}} value="1">@lang('Active')</option>
                                            <option {{$user->status == 0? 'selected':''}} value="0">@lang('Banded')</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success btn-block ">@lang('UPDATE')</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

