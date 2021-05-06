@extends('admin.layouts.master')

@section('title',__('Withdraw'))
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>@lang('Withdraw Payment Methods') <a href="#addModal" data-toggle="modal" class="btn btn-dark btn-sm float-right"><i class="fa fa-plus"></i> @lang('Add New')</a> </h2>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>@lang('Method Name')</th>
                            <th>@lang('Method Logo')</th>
                            <th>@lang('Min Amount')</th>
                            <th>@lang('Max Amount')</th>
                            <th>@lang('Fix Charge')</th>
                            <th>@lang('Percent of Charge')</th>
                            <th>@lang('Rate')</th>
                            <th>@lang('Processing Day')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($withdraw as $key=> $data)
                            <tr id="row1">
                                <td> <b>{{$data->name}}</b></td>
                                <td> <img class="width-height-80" src="{{asset('images/withdraw_methods/'.$data->image)}}"></td>
                                <td> {{$data->min_amo}} </td>
                                <td> {{$data->max_amo}} </td>
                                <td> {{$data->chargefx}} {{$general->currency}}</td>
                                <td> {{$data->chargepc}} %</td>
                                <td> {{$data->rate}}</td>
                                <td> {{$data->processing_day}} @lang('Days')</td>
                                <td>
                                    @if($data->status == 1)
                                        <span class="badge badge-info">@lang('Active')</span>
                                    @else
                                        <span class="badge badge-danger">@lang('Inactive')</span>
                                    @endif
                                </td>
                                <td><a class="btn btn-primary" data-toggle="modal" href="#editModal{{$data->id}}">@lang('Edit') </a></td>
                            </tr>

                            <div id="editModal{{$data->id}}" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">@lang('Edit') {{$data->name}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form role="form" method="post" action="{{route('update.withdraw.method', $data->id)}}" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                {{csrf_field()}}
                                                {{method_field('put')}}
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12">
                                                            <label class="control-label">@lang('Payment Method Image')</label>
                                                            <input class="form-control" type="file" name="image">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12">
                                                            <label class="control-label">@lang('Payment Method Name')</label>
                                                            <input class="form-control text-capitalize" value="{{$data->name}}" type="text" required name="name">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12">
                                                            <label class="control-label">@lang('Minimum Amount For Withdraw') ( {{$general->currency}} )</label>
                                                            <div class="input-group">
                                                                <input class="form-control text-capitalize" value="{{$data->min_amo}}" type="number" required name="min_amo">
                                                                <span class="input-group-addon"> {{$general->currency}}</span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12">
                                                            <label class="control-label">@lang('Maximum Amount For Withdraw')</label>
                                                            <div class="input-group">
                                                                <input class="form-control text-capitalize"  value="{{$data->max_amo}}" type="number" required name="max_amo">
                                                                <span class="input-group-addon"> {{$general->currency}}</span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12">
                                                            <label class="control-label">@lang('Fixed Charge For With Draw') ( {{$general->currency}} )</label>
                                                            <div class="input-group">
                                                                <input class="form-control text-capitalize"  value="{{$data->chargefx}}"  type="text" required name="chargefx">
                                                                <span class="input-group-addon"> {{$general->currency}}</span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12">
                                                            <label class="control-label">@lang('Charge Percentage') ( {{$general->currency}} )</label>
                                                            <div class="input-group">
                                                                <input class="form-control text-capitalize" value="{{$data->chargepc}}"  type="text" required name="chargepc">
                                                                <span class="input-group-addon"> %</span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12">
                                                            <label class="control-label">@lang('Rate for 1') {{$data->currency}}</label>
                                                            <div class="input-group">
                                                                <input class="form-control text-capitalize" placeholder="Rate" value="{{$data->rate}}" type="text" required name="rate">
                                                                <span class="input-group-addon"> {{$general->currency}}</span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <div class="col-md-12">
                                                                <label class="control-label">@lang('Method Currency')</label>
                                                                <div class="input-group">
                                                                    <input class="form-control text-capitalize" value="{{$data->currency}}" placeholder="Currency" type="text" required name="currency">
                                                                    <span class="input-group-addon"> {{$data->currency}}</span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12">
                                                            <label class="control-label">@lang('Payback Days')</label>
                                                            <div class="input-group">
                                                                <input class="form-control text-capitalize" placeholder="Day" value="{{$data->processing_day}}" type="text" required name="processing_day">
                                                                <span class="input-group-addon">@lang('Days')</span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12">
                                                            <label class="control-label">@lang('Status')</label>
                                                            <select class="form-control" name="status">
                                                                <option  @if($data->status == 1) selected @else   @endif value="1">@lang('Active')</option>
                                                                <option @if($data->status == 0) selected @else   @endif value="0">@lang('Inactive')</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <div class="col-md-12">
                                                    <button type="button" data-dismiss="modal" class="btn btn-sm btn-danger">@lang('Cancel')</button>
                                                    <button type="submit" class="btn btn-sm btn-success"> @lang('Update')</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="addModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add Gateway')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" role="form" method="post" action="{{route('store.withdraw.method')}}" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="control-label">@lang('Payment Method Image')</label>
                                    <input class="form-control"  type="file" required name="image">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="control-label">@lang('Payment Method Name')</label>
                                    <input class="form-control text-capitalize" placeholder="@lang('Method Name')" type="text" required name="name">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="control-label">@lang('Minimum Amount For Withdraw')</label>
                                    <div class="input-group">
                                        <input class="form-control text-capitalize" placeholder="@lang('Minimum Amount')" type="number" required name="min_amo">
                                        <span class="input-group-addon"> {{$general->currency}}</span>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="control-label">@lang('Maximum Amount For Withdraw')</label>
                                    <div class="input-group">
                                        <input class="form-control text-capitalize" placeholder="@lang('Maximum Amount')" type="number" required name="max_amo">
                                        <span class="input-group-addon"> {{$general->currency}}</span>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="control-label">@lang('Fixed Charge For With Draw')</label>
                                    <div class="input-group">
                                        <input class="form-control text-capitalize" placeholder="@lang('Charge')" type="text" required name="chargefx">
                                        <span class="input-group-addon"> {{$general->currency}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="control-label">@lang('Charge Percentage')</label>
                                    <div class="input-group">
                                        <input class="form-control text-capitalize" placeholder="@lang('Charge Percentage')" type="text" required name="chargepc">
                                        <span class="input-group-addon">%</span>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="control-label">@lang('Rate for 1 Method Currency')</label>
                                    <div class="input-group">
                                        <input class="form-control text-capitalize" placeholder="@lang('Rate')" type="text" required name="rate">
                                        <span class="input-group-addon">@lang('Currency')</span>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="control-label">@lang('Method Currency')</label>
                                    <input class="form-control text-capitalize" placeholder="@lang('Currency')" type="text" required name="currency">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="control-label">@lang('Payback Days')</label>
                                    <div class="input-group">
                                        <input class="form-control text-capitalize" placeholder="@lang('Day')" type="text" required name="processing_day">
                                        <span class="input-group-addon">@lang('Days')</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-sm btn-danger">@lang('Cancel')</button>
                        <button type="submit" class="btn btn-sm btn-success"> @lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection