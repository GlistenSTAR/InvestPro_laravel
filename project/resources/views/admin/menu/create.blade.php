@extends('admin.layouts.master')

@section('title',__('Menu Create'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('Create')</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('menu-area.store')}}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>@lang('Title')</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>

                            <div class="form-group col-md-12">
                                <label >@lang('Description')</label>
                                <textarea class="form-control" name="description" rows="30" required></textarea>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-dark mt-2">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

