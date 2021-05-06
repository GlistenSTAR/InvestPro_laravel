@extends('admin.layouts.master')

@section('title',__('User Management'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card pt-4">
                <div class="card-header">
                    <div class="card-title uppercase bold"><i class="fa fa-search"></i> @lang('Search Users')</div>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-6">
                            <form class="form-horizontal" method="GET" action="{{route('username.search')}}">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="username" required placeholder="@lang('Search By Name')" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">@lang('Search')</button>
                                </div>
                            </div>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <form class="form-horizontal" method="GET" action="{{route('email.search')}}">
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" name="email"  placeholder="@lang('Search By Email')" aria-describedby="basic-addon1">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">@lang('Search')</button>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-12 mt-4">
                <div class="card pt-3">
                    <div class="card-header">
                        <div class="card-title"><i class="fa fa-user"></i> @lang('User List')</div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-sm table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th> @lang('Sl')</th>
                                <th> @lang('Name') </th>
                                <th>@lang('Email')</th>
                                <th>@lang('Mobile')</th>
                                <th> @lang('Balance')</th>
                                <th> @lang('Action') </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user as $key => $data)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$data->name}}</td>
                                    <td><b>{{$data->email}}</b></td>
                                    <td>{{ $data->mobile}}</td>
                                    <td>{{ round($data->balance,8) }}{{$general->currency}}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{route('user.view', $data->id)}}"><i class="fa fa-desktop"></i>  @lang('View Detail')</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-12 text-center">{{$user->links()}}</div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection

