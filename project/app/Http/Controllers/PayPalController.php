<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\General;
use App\Http\Controllers\DepositController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    public function payment()
    {
        try {
            $track = Session::get('Track');
            $depositData = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();
            $gnl = General::first();


            $data = [];
            $data['items'] = [
                [
                    'name' => $gnl->web_name,
                    'price' => floatval($depositData['usd_amo']),
                    'desc'  => 'Add Fund for '.$gnl->web_name.' & trx :'.$depositData->trx,
                    'qty' => 1
                ]
            ];
            $credantital = [
                'mode'    => 'live',
                'sandbox' => [
                    'username' => $depositData->gateway->gateway_key_one,
                    'password' => $depositData->gateway->gateway_key_two,
                    'secret' => $depositData->gateway->gateway_key_three,
                    'certificate' => '',
                    'app_id'      => $depositData->gateway->gateway_key_four,
                ],
                'live' => [
                    'username' => $depositData->gateway->gateway_key_one,
                    'password' => $depositData->gateway->gateway_key_two,
                    'secret' => $depositData->gateway->gateway_key_three,
                    'certificate' => '',
                    'app_id'      => $depositData->gateway->gateway_key_four,
                ],
                'payment_action' => 'Sale',
                'currency'       => 'USD',
                'billing_type'   => 'MerchantInitiatedBilling',
                'notify_url'     => '',
                'locale'         => '',
                'validate_ssl'   => true,

            ];

            $data['invoice_id'] = $depositData->trx;
            $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
            $data['return_url'] = route('paypal.payment.success');
            $data['cancel_url'] = route('paypal.payment.cancel');
            $data['total'] = floatval($depositData['usd_amo']);
            $provider = new ExpressCheckout;
            $provider->setApiCredentials($credantital);
            $response = $provider->setExpressCheckout($data);
            $response = $provider->setExpressCheckout($data, true);

            return redirect($response['paypal_link']);
        }catch (\Exception $e){
            return redirect()->route('users.showDepositMethods')->with('alert', $e->getMessage());
        }
    }

    public function cancel()
    {
        return redirect()->route('users.showDepositMethods')->with('alert', 'Sorry you payment is canceled');
    }


    public function success(Request $request, DepositController $controller)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
        $deposit = Deposit::where('trx',$response['INVNUM'])->first();
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            return $controller->userDataUpdate($deposit);
        }
        return redirect()->route('users.showDepositMethods')->with('alert', 'Something is wrong.');
    }
}
