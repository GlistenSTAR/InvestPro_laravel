<?php

namespace App\Http\Controllers;


use App\Deposit;
use App\General;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Charge;
use App\Http\Controllers\DepositController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class StripeController extends Controller
{
       public function ipnstripe(Request $request, DepositController $controller)
   {
       $track = Session::get('Track');
       $data = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();
       $cnts = round($data->usd_amo,2) * 100;
       $gatewayData = $data->gateway;;

       Stripe::setApiKey($gatewayData->gateway_key_one);
       try {
           $charge = Charge::create(array(
               "amount" => $cnts,
               "currency" => "usd",
               "source" => $request->stripeToken,
               "description" => "item"
           ));
           if ($charge['status'] == 'succeeded') {
               //Update User Data
                return $controller->userDataUpdate($data);
           }
       }catch (Exception $e)
       {
           return redirect()->route('users.showDepositMethods')->with('alert', $e->getMessage());
       }

   }
}
