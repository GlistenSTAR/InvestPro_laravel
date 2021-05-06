@extends('front.layouts.master')
@section('title',__('Transfer Your Balance'))
@section('content')
    <div class="check-profit-area pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form method="POST" action="{{ route('transfer.store') }}">
                        @csrf
                        <div class="title text-center">
                            <h5>{{__('Share your Balance with Other User')}}</h5>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <p class="text-danger"> {{$general->bal_trans_percentage_charge}}% {{__('Transfer Charge will Applied and transferred Fund will go to Secondary Balance.')}}</p>
                                <p class="text-danger"> {{$general->bal_trans_fixed_charge}} {{$general->currency}} {{__('fixed transfer Charge will Applied and transferred Fund will go to Secondary Balance.')}}</p>
                                <hr>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{__('Receiver Email')}} :</label>
                            <input type="email" name="email" class="form-control" placeholder="{{__('Email to Transfer')}}" required autocomplete="email" autofocus>
                        </div>
                        <div class="form-group">
                            <label>{{__('Amount')}} :</label>
                            <input type="text" name="amount" class="form-control" id="amount" placeholder="{{__('AMOUNT YOU WANT TO SHARE')}}" autocomplete="off" required>
                            <span class="text-danger wrnMsg"></span>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">{{__('Transfer Now')}}</button>
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
        $(document).ready(function () {
            let fixedCharge, percentCharge;
            fixedCharge = '{{$general->bal_trans_fixed_charge}}';
            percentCharge = '{{$general->bal_trans_percentage_charge}}';
            $('#amount').on('keyup',function () {
                var amt = this.value;
                if (($.isNumeric(amt)) && (parseFloat(amt) > 0)){
                    var perCharge = (parseFloat(amt)*parseFloat(percentCharge))/100;
                    var totalCharge = perCharge+parseFloat(fixedCharge);
                    var total = parseFloat(amt)+parseFloat(totalCharge);
                    msg('Total '+parseFloat(total)+' {{$general->currency}} wil deduct from your balance.');
                } else {
                    msg('Amount should be numeric & greater than 0');
                }

            });
            function msg(msg) {
                $('.wrnMsg').text(msg);
            }
        });
        })(jQuery);
    </script>
@endsection
