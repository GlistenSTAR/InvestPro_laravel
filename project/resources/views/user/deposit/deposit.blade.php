@extends('front.layouts.master')

@section('title', __('Add Fund'))

@section('style')
    <link rel="stylesheet" href="{{asset('user/css/user-deposit.css')}}">
@stop

@section('content')

    <div class="check-profit-area pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">
                            <div class="stepwizard-step col-xs-3">
                                <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                            <p><small>{{__('Amount')}}</small></p>
                            </div>
                            <div class="stepwizard-step col-xs-3">
                                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                            <p><small>{{__('Gateway')}}</small></p>
                            </div>


                        </div>
                    </div>

                    <form role="form" method="POST" action="{{ route('submit.amount.deposit') }}" id="submitPayment" enctype="multipart/form-data">
                        @csrf
                        <div class="card panel-primary mt-5 setup-content" id="step-1">
                            <div class="card-header panel-heading">
                                <h3 class="panel-title text-center">{{__('Put Your Deposit Amount')}}</h3>
                            </div>
                            <div class="card-body panel-body">
                                <div class="form-group">
                                    <label class="control-label">{{__('Amount')}}</label>
                                    <input maxlength="100" type="text" required="required" class="form-control" autocomplete="off" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" name="amount"  id="amount" placeholder="{{__('AMOUNT')}}" />
                                </div>
                            <button class="btn btn-primary nextBtn pull-right" type="button">{{__('Next')}}</button>
                            </div>
                        </div>

                        <div class="panel panel-primary setup-content mt-5" id="step-2">
                            <div class="panel-heading">
                            <h3 class="panel-title text-center">{{__('Select Payment Gateway')}}</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    @foreach($gateways as $gate)
                                        <div class="card col-md-4 mb-5">
                                            <div class="card-header">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" id="customRadio{{$gate->id}}" name="gateway" data-valFour="{{clean(nl2br($gate->gateway_key_four))}}" value="{{$gate->id}}">
                                                    <label class="custom-control-label" for="customRadio{{$gate->id}}">{{$gate->name}}</label>
                                                </div></div>
                                            <div class="card-body">
                                                <img src="{{asset('images/gateway/'.$gate->image)}}">
                                            </div>
                                            <div class="card-footer text-center">
                                                <p class="text-success">{{__('Min-Max')}} :{{$gate->minimum_deposit_amount}} - {{$gate->maximum_deposit_amount}} {{$general->currency}}</p>
                                                <small class="text-danger"> {{__('Fixed Charge')}} : {{$gate->fixed_charge}} {{$general->currency}} & {{__('Percentage Charge')}} : {{$gate->percentage_charge}}%</small>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-12">


                                          <div class="modal fade" id="depositModal" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{__('Deposit via')}} <strong>{{$gate->name}}</strong></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="post" action="{{route('submit.amount.deposit')}}" enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="modal-body">

                                                                <strong class="text-dark">{{__('Payment Details')}}</strong> <small>{{__('(Send Here)')}}</small><br>
                                                                <div class="gateWayFour">

                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputRecipt" class="text-dark"><strong>{{__('Receipt Image')}}</strong></label>
                                                                    <input type="file" class="form-control" name="receipt">
                                                                </div>

                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">{{__('Preview')}}</button>
                                                            <button type="button" class="btn btn-danger " data-dismiss="modal">{{__('Close')}}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <button class="btn btn-success pull-right subPre" type="button">{{__('Submit & Preview')}}</button>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>

            </div>
        </div>
    </div>





@endsection

@section('script')
    <script>
         (function($) {
            "use strict";


        $(".subPre").on('click',function() {
            document.getElementById('submitPayment').submit();
        });


        $(document).ready(function () {
            $(".custom-control-input").change(function() {
                if(this.checked && $(this).val() > 3) {
                    $('#depositModal').modal('show');
                    $('.gateWayFour').html($(this).attr('data-valFour'));
                }
            });

            var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn');

            allWells.hide();

            navListItems.click(function (e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                    $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-success').addClass('btn-default');
                    $item.addClass('btn-success');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });

            allNextBtn.click(function () {
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                    isValid = true;

                $(".form-group").removeClass("has-error");
                for (var i = 0; i < curInputs.length; i++) {
                    if (!curInputs[i].validity.valid) {
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }

                if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
            });

            $('div.setup-panel div a.btn-success').trigger('click');
        });

    })(jQuery);

    </script>

@stop
