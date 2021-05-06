@extends('admin.layouts.master')
@section('style')
    <link href="{{asset('admin/css/bootstrap-fileinput.css')}}" rel="stylesheet">
@endsection
@section('title',__('Gateway'))
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title ">{{$page_title}}


                        <button type="button" class="btn btn-success pull-right btn-sm" data-toggle="modal" data-target="#addModal">
                            <i class="fa fa-plus"></i> @lang('Add Gateway')
                        </button>

                </h3>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered table-hover text-center">
                            <thead>
                            <tr>
                                <th>@lang('SL')</th>
                                <th>@lang('Gateway')</th>

                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($gateways as $k=>$gateway)
                                <tr>
                                    <td>{{ ++$k }}</td>
                                    <td>{{$gateway->name}}</td>
                                    <td>
                                        @if($gateway->status == 1)
                                            <span class="badge  badge-pill  badge-success">@lang('Active')</span>
                                        @else
                                            <span class="badge  badge-pill  badge-danger">@lang('Inactive')</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm"
                                                data-toggle="modal" data-target="#editModal{{$gateway->id}}"
                                                data-act="Edit">
                                            Edit
                                        </button>
                                    </td>
                                </tr>


                                <!-- Modal for Edit button -->
                                <div class="modal fade editModal" id="editModal{{$gateway->id}}" tabindex="-1"
                                     role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">@lang('Edit')
                                                    <strong>{{$gateway->name}}</strong></h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">&times;
                                                </button>
                                            </div>
                                            <form method="post" action="{{route('update.gateway')}}"
                                                  enctype="multipart/form-data">
                                                {{ csrf_field() }}

                                                <input class="form-control" value="{{$gateway->id}}"
                                                       type="hidden" name="id">
                                                <div class="modal-body">
                                                    {{csrf_field()}}
                                                    <input class="form-control abir_id" value="{{$gateway->id}}" type="hidden" name="id">
                                                    <div class="form-group">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail width-height-200" >
                                                                <img src="{{asset('images/gateway/'.$gateway->image)}}" alt="*" />
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail width-height-200"> </div>
                                                            <div>
                                                              <span class="btn btn-success btn-file">
                                                              <span class="fileinput-new"> @lang('Change Logo') </span>
                                                              <span class="fileinput-exists"> @lang('Change') </span>
                                                              <input type="file" name="image"> </span>
                                                                <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> @lang('Remove') </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <strong>@lang('Name of Gateway')</strong>
                                                                <input type="text" value="{{$gateway->name}}" class="form-control" id="name" name="name" >
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>@lang('Rate')</strong>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">1 USD=</span>
                                                                    </div>
                                                                    <input name="rate" value="{{$gateway->rate}}" type="text" class="form-control">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">{{$general->currency}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="card mb-3 max-width-18rem">
                                                                <div class="card-header bg-primary text-white"><strong>Deposit Limit</strong></div>
                                                                <div class="card-body">
                                                                    <strong>Minimum Amount</strong>
                                                                    <div class="input-group mb-3">
                                                                        <input value="{{$gateway->minimum_deposit_amount}}" type="text" name="minimum_deposit_amount" class="form-control" >
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text" id="basic-addon2">{{$general->currency}}</span>
                                                                        </div>
                                                                    </div>
                                                                    <strong>Maximum Amount</strong>
                                                                    <div class="input-group mb-3">
                                                                        <input value="{{$gateway->maximum_deposit_amount}}" type="text" name="maximum_deposit_amount" class="form-control">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text" id="basic-addon2">{{$general->currency}}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card mb-3 max-width-18rem">
                                                                <div class="card-header bg-primary text-white"><strong>@lang('Deposit Charge')</strong></div>
                                                                <div class="card-body">
                                                                    <strong>@lang('Fixed Charge')</strong>
                                                                    <div class="input-group mb-3">
                                                                        <input value="{{$gateway->fixed_charge}}" type="text" name="fixed_charge" class="form-control" >
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text" id="basic-addon2">{{$general->currency}}</span>
                                                                        </div>
                                                                    </div>
                                                                    <strong>@lang('Charge in Percentage')</strong>
                                                                    <div class="input-group mb-3">
                                                                        <input value="{{$gateway->percentage_charge}}" type="text" name="percentage_charge" class="form-control">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text" id="basic-addon2">%</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if ($gateway->id > 3)
                                                        <div class="form-group">
                                                            <strong>@lang('PAYMENT DETAILS')</strong>
                                                            <textarea class="form-control" name="gateway_key_four" rows="3" cols="80">{!! $gateway->gateway_key_four !!}</textarea>
                                                        </div>
                                                    @endif

                                                    @if($gateway->id==1)
                                                        <div class="form-group">
                                                            <strong>@lang('PAYPAL API USERNAME')</strong>
                                                            <input type="text" value="{{$gateway->gateway_key_one}}" class="form-control" id="gateway_key_one" name="gateway_key_one" >
                                                        </div>

                                                        <div class="form-group">
                                                            <strong>@lang('PAYPAL API PASSWORD')</strong>
                                                            <input type="text" value="{{$gateway->gateway_key_two}}" class="form-control" id="gateway_key_two" name="gateway_key_two" >
                                                        </div>

                                                        <div class="form-group">
                                                            <strong>@lang('PAYPAL API SECRET')</strong>
                                                            <input type="text" value="{{$gateway->gateway_key_three}}" class="form-control" id="gateway_key_three" name="gateway_key_three" >
                                                        </div>
                                                    @endif

                                                    @if($gateway->id==2)
                                                        <div class="form-group">
                                                            <strong>@lang('COINPAYMENT MERCHANT ID')</strong>
                                                            <input type="text" value="{{$gateway->gateway_key_one}}" class="form-control" id="gateway_key_one" name="gateway_key_one" >
                                                        </div>

                                                         <div class="form-group">
                                                            <strong>@lang('COINPAYMENT SECRET')</strong>
                                                            <input type="text" value="{{$gateway->gateway_key_two}}" class="form-control" id="gateway_key_two" name="gateway_key_two" >
                                                        </div>

                                                    @endif

                                                    @if($gateway->id==3)
                                                        <div class="form-group">
                                                            <strong>@lang('STRIPE SECRET')</strong>
                                                            <input type="text" value="{{$gateway->gateway_key_one}}" class="form-control" id="gateway_key_one" name="gateway_key_one" >
                                                        </div>

                                                        <div class="form-group">
                                                            <strong>@lang('STRIPE KEY')</strong>
                                                            <input type="text" value="{{$gateway->gateway_key_two}}" class="form-control" id="gateway_key_two" name="gateway_key_two" >
                                                        </div>
                                                    @endif

                                                    <div class="form-group">
                                                        <strong>Status</strong>
                                                        <select class="form-control" name="status">
                                                            <option value="1" {{$gateway->status==1?'selected':''}}>@lang('Active')</option>
                                                            <option value="0" {{$gateway->status==0?'selected':''}}>@lang('Inactive')</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">

                                                    <button type="button" class=" btn btn-danger" data-dismiss="modal"
                                                            aria-hidden="true">@lang('Close')
                                                    </button>
                                                    <button type="submit" class="btn btn-success ">@lang('Save Changes')</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="" action="{{route('store.gateway')}}" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('Add Payment Gateway')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{csrf_field()}}

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <strong>@lang('Gateway Image')</strong>
                                    <input type="file" value="" class="form-control" id="image" name="image" required>
                                </div>

                                <div class="col-md-6">
                                    <strong>@lang('Name of Gateway')</strong>
                                    <input type="text" value="" class="form-control" id="name" name="name" >
                                </div>
                                <div class="col-md-6">
                                    <strong>@lang('Rate')</strong>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">1 USD = </span>
                                        </div>
                                        <input name="rate" type="text" class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text"> {{ $general->currency }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-3 max-width-18rem">
                                    <div class="card-header bg-primary text-white"><strong>@lang('Deposit Limit')</strong></div>
                                    <div class="card-body">
                                        <strong>@lang('Minimum Amount')</strong>
                                        <div class="input-group mb-3">
                                            <input type="text" name="minimum_deposit_amount" class="form-control" >
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">{{$general->currency}}</span>
                                            </div>
                                        </div>
                                        <strong>@lang('Maximum Amount')</strong>
                                        <div class="input-group mb-3">
                                            <input type="text" name="maximum_deposit_amount" class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">{{$general->currency}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3 max-width-18rem">
                                    <div class="card-header bg-primary text-white"><strong>@lang('Deposit Charge')</strong></div>
                                    <div class="card-body">
                                        <strong>@lang('Fixed Charge')</strong>
                                        <div class="input-group mb-3">
                                            <input type="text" name="fixed_charge" class="form-control" placeholder="">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">{{$general->currency}}</span>
                                            </div>
                                        </div>
                                        <strong>@lang('Charge in Percentage')</strong>
                                        <div class="input-group mb-3">
                                            <input type="text" name="percentage_charge" class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <strong>@lang('Payment Details')</strong>
                            <textarea name="gateway_key_four" rows="3" cols="80" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <h5 for="status"><strong>@lang('Status')</strong></h5>
                            <select class="form-control" name="status">
                                <option value="1">@lang('Active')</option>
                                <option value="0">@lang('Inactive')</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">@lang('ADD')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
