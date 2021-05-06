<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentGatway;

use App\General;
use App\Deposit;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Charge;
use App\Transaction;
use App\DepositRequest;

use App\Lib\coinPayments;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class PaymentGatwayController extends Controller
{
    public function addDeposit() {
        $data['gateways'] = PaymentGatway::where('status', 1)->get();
        $data['page_title'] = 'Add Fund';
        return view('user.deposit.deposit', $data);
    }

    public function depositAmountInsert(Request $request){


        $this->validate($request, [
            'amount' => 'required|numeric|min:0',
            'gateway' => 'required|integer'
        ]);
       $gateway = PaymentGatway::whereStatus(1)->whereId($request->gateway)->first();
       if ($gateway instanceof PaymentGatway){
           $trx = Str::random(16);
           if ($gateway->minimum_deposit_amount <= $request->amount && $gateway->maximum_deposit_amount >= $request->amount) {
               $charge = $gateway->fixed_charge + ($request->amount * $gateway->percentage_charge / 100);
               $usdamo = ($request->amount + $charge) / $gateway->rate;


               if ($gateway->id > 3) {


                   $dr = new DepositRequest;
                   $dr->user_id = Auth::user()->id;
                   $dr->gateway_id = $gateway->id;
                   $dr->amount = floatval($request->amount);
                   $dr->charge = $charge;
                   $dr->usd_amo = floatval($usdamo);
                   $dr->trx = $trx;
                   if ($request->hasFile('receipt')) {
                       $image = $request->file('receipt');
                       if (!in_array($image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png'])) {
                           Session::flash('alert', 'File format must be jpg, jpeg, png');
                           return redirect()->back();
                       }
                       $fileName = time() . '.jpg';
                       $location = './public/images/receipt_img/' . $fileName;
                       Image::make($image)->save($location);
                       $dr->r_img = $fileName;
                   } else {
                       Session::flash('alert', 'Receipt image is required');
                       return redirect()->back();
                   }
                   $dr->save();
               }
               $depo['user_id'] = Auth::id();
               $depo['gateway_id'] = $gateway->id;
               $depo['amount'] = $request->amount;
               $depo['charge'] = $charge;
               $depo['usd_amo'] = round($usdamo, 2);
               $depo['btc_amo'] = 0;
               $depo['btc_wallet'] = "";
               $depo['trx'] = $trx;
               $depo['try'] = 0;
               $depo['status'] = 0;
               Deposit::create($depo);
               Session::put('Track', $depo['trx']);
               return redirect()->route('user.deposit.preview');
           }
           return back()->with('alert', 'Minimum :'.$gateway->minimum_deposit_amount. ' & Maximum'. $gateway->maximum_deposit_amount.' amount is required for '.$gateway->name);
       }
        return back()->with('alert', 'Gateway not found please try again.');
    }

    public function depositPreview(){
        $track = Session::get('Track');
        $data = Deposit::where('status',0)->where('trx',$track)->first();
        $drcount = DepositRequest::where('trx',$track)->count();
        if ($drcount > 0) {
            $dr = DepositRequest::where('trx',$track)->first();
        } else {
            $dr = '';
        }
        $page_title = 'Deposit Preview';
        return view('user.deposit.preview',compact('page_title','data', 'dr'));
    }

      public function depositPayNow(){

        $track = Session::get('Track');
        $data = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();
        $gnl = General::first();


        if(!$data instanceof Deposit) {

            return redirect()->route('users.showDepositMethods')->with('alert', 'Invalid Deposit Request');
        }
        
        try {
            $method = $data->gateway;

            if ($data->gateway_id == 1){
                return App::call('App\Http\Controllers\PayPalController@payment');
            }

            if ($data->gateway_id == 2){

            	$all = file_get_contents("https://blockchain.info/ticker");
               $res = json_decode($all);
               $btcrate = $res->USD->last;
               $amon = $data->amount;
               $usd = $data->usd_amo;
               $bcoin = round($usd/$btcrate,8);
               $callbackUrl = route('ipn.coinpayemnt');
               $CP = new coinPayments();


               $CP->setMerchantId($method->gateway_key_one);
               $CP->setSecretKey($method->gateway_key_two);
               $ntrc = $data->trx;
               $form = $CP->createPayment('Deposit', 'BTC',  $bcoin, $ntrc, $callbackUrl);
               $page_title = $method->name;
               return view('user.deposit.payment_views.coinpay', compact('bcoin','form','page_title','amon', 'gnl'));
            }

           if ($data->gateway_id == 3){
            $gatewayData = $data->gateway;
             $page_title = $gatewayData->name;
              return view('user.deposit.payment_views.stripe', compact('track','page_title','gatewayData'));
            }

            if ($data->gateway_id > 3) {

                $dr = DepositRequest::where('trx',$track)->first();
                $dr->sent = 1;
                $dr->save();
                $data->status = 1;
                $data->save();
                Session::flash('success', 'Deposit request sent successfully!');
                return redirect()->route('users.showDepositMethods');
            }


        return redirect()->route('users.showDepositMethods')->with('alert', 'Something went wrong please try again latter.');

        }catch (\Exception $e){
            return redirect()->route('users.showDepositMethods')->with('alert', $e->getMessage());
        }

    }
}
