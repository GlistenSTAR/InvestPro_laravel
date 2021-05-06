<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DepositController;
use App\Deposit;

class CoinpaymentController extends Controller
{
       public function ipnCoinPayBtc(Request $request, DepositController $controller)
   {
       $track = $request->custom;
       $status = $request->status;
       $amount2 = floatval($request->amount2);
       $currency2 = $request->currency2;

        $track = Session::get('Track');
        $data = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();

       $bcoin = $data->btc_amo;
       if ($status>=100 || $status==2){
           if ($currency2 == "BTC" && $data->status == '0' && $data->btc_amo<=$amount2){
           	 return $controller->userDataUpdate($data);
           }
       }
   }
}
