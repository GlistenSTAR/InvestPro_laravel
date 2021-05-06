@extends('admin.layouts.master')
@section('title',__('About'))
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-title">
                   <h2>@lang('Short Code')</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> @lang('CODE') </th>
                            <th> @lang('DESCRIPTION') </th>
                        </tr>
                        </thead>
                        <tbody>


                        <tr>
                            <td> 1 </td>
                            <td> <pre>&#123;&#123;message&#125;&#125;</pre> </td>
                            <td> @lang('Details Text From Script')</td>
                        </tr>

                        <tr>
                            <td> 2 </td>
                            <td> <pre>&#123;&#123;name&#125;&#125;</pre> </td>
                            <td> @lang('Users Name. Will Pull From Database and Use in EMAIL text')</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('Email Template')</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('general.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>@lang('Email Sent Form')</label>
                            <input type="email" name="esender" class="form-control" value="{{$general->esender}}">
                        </div>
                        <div class="form-group">
                            <label>@lang('Email Message')</label>
                            <textarea class="form-control" name="email_template" rows="10">{{$general->email_template}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">@lang('Update')</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

