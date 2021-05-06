@extends('admin.layouts.master')
@section('title',__('User Management'))
@section('content')
    <div class="row">

        <div class="col-md-6 mb-5">
            <div class="card">
                <div class="card-header">
                    <div class="caption uppercase bold">
                        <i class="fas fa-money-bill-alt"></i> @lang('CURRENT BALANCE')</div>
                </div>
                <div class="card-body uppercase text-center">
                    <h3>@lang('CURRENT BALANCE OF') <strong>{{$user->name}}</strong></h3>
                    <h1><strong> {{$user->balance}} {{$general->currency}}</strong></h1>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="caption uppercase bold">
                        <i class="fa fa-cog"></i> @lang('Add/Deduct balance')
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('user.balance.update', $user->id)}}" method="post">
                        {{csrf_field()}}
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label><strong>@lang('OPERATION')</strong></label>
                                <select name="operation" class="form-control">
                                    <option value="1">@lang('Add Money')</option>
                                    <option value="0">@lang('Deduct Money')</option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <label><strong>@lang('Amount')</strong></label>
                                <div class="input-group ">
                                    <input type="text" class="form-control" name="amount" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">{{$general->currency}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label><strong>@lang('Message')</strong></label>
                                <textarea name="message" rows="5" class="form-control"  placeholder="@lang('if any')"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"> @lang('SUBMIT') </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
