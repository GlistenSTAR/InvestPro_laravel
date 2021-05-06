@extends('front.layouts.master')

@section('title', __('Stripe'))

@section('content')
<section class="section-padding section-background bg-white ">
<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2 mb-5">
				<div class="well">
					<h1 class="text-center">{{__('Stripe Payment')}}</h1>
					<hr/>
					<div class="row">
						<div class="col-md-12">
							<div class="card-wrapper"></div>
						</div>
					</div>
					<form role="form" action="{{ route('ipn.stripe')}}" method="post" class="require-validation"
						  data-cc-on-file="false"
						  data-stripe-publishable-key="{{ $gatewayData->gateway_key_two }}"
						  id="payment-form">
						@csrf

						<div class='form-row row'>
							<div class='col-xs-12 col-md-12 form-group required'>
								<label class='control-label'>{{__('Name on Card')}}</label> <input
										class='form-control' size='4' type='text'>
							</div>
						</div>

						<div class='form-row row'>
							<div class='col-xs-12 col-md-12 form-group card required'>
								<label class='control-label'>{{__('Card Number')}}</label> <input
										autocomplete='off' class='form-control card-number' size='20'
										type='text'>
							</div>
						</div>

						<div class='form-row row'>
							<div class='col-xs-12 col-md-4 form-group cvc required'>
								<label class='control-label'>{{__('CVC')}}</label> <input autocomplete='off'
																				class='form-control card-cvc' placeholder='{{__('ex. 311')}}' size='4'
																				type='text'>
							</div>
							<div class='col-xs-12 col-md-4 form-group expiration required'>
								<label class='control-label'>{{__('Expiration Month')}}</label> <input
										class='form-control card-expiry-month' placeholder='MM' size='2'
										type='text'>
							</div>
							<div class='col-xs-12 col-md-4 form-group expiration required'>
								<label class='control-label'>{{__('Expiration Year')}}</label> <input
										class='form-control card-expiry-year' placeholder='{{__('YYYY')}}' size='4'
										type='text'>
							</div>
						</div>

						<div class='form-row row'>
							<div class='col-md-12 error form-group hide'>
								<div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-md-12">
								<button class="btn btn-primary btn-lg btn-block" type="submit">{{__('Pay Now')}}</button>
							</div>
						</div>

					</form>
				</div>

		</div>
	</div>
</div>
</section>

@stop

@section('script')
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script type="text/javascript">
        $(function() {
            "use strict";

            $('.hide').css('display','none');

            var $form         = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                var $form         = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs       = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid         = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });
                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        })(jQuery); 
	</script>
@endsection
