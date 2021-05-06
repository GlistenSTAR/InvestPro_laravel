<?php

namespace App\Http\Controllers;

use App\General;
use App\PaymentGatway;
use Illuminate\Http\Request;
use App\Gateway;
use App\Deposit;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Charge;
use App\Transaction;
use App\DepositRequest as DR;
use App\Lib\BlockIo;
use App\Lib\coinPayments;
use App\Lib\CoinPaymentHosted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;


class DepositController extends Controller
{

    public function userDataUpdate($data)
    {
        if($data->status==0){
            $data['status'] = 1;
            $data->update();
            $user = User::find($data->user_id);
            createTransaction("Deposit via " . $data->gateway->name,$data->amount,$user->balance,$user->balance + $data->amount,1);

            $user['balance'] = $user->balance + $data->amount;
            $user->update();
            $gnl = General::first();
             $msg =  'Deposit Payment Successful';
             send_email($user->email, $user->name, 'Deposited Successfully Via '. $data->gateway->name, $msg);
            Session::flash('success', 'Deposited ' . $data->amount . ' ' . $gnl->currency . ' successfully');
            return redirect()->route('users.showDepositMethods');
        }
    }
}
