<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\Gateway;
use App\General;
use App\InvestLog;
use App\Plan;
use App\Referral;
use App\Transaction;
use App\User;
use App\WithdrawLog;
use App\WithdrawMethod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    protected function totalEarn($investLog){
        if (count($investLog) > 0){
            $totalEarn = 0;
            foreach ($investLog as $value){
                $totalEarn +=((floatval($value->invest_amount) * floatval($value->get_percent))/100)*$value->took_action;
            }
            $total_earn = round($totalEarn,2);
        }else{
            $total_earn = 0;
        }
        return $total_earn;
    }

    public function index()
    {
        $investLog = InvestLog::where('user_id',\auth()->id())->get();
        $data['total_earn'] = $this->totalEarn($investLog);
        $data['total_withdraw'] = WithdrawLog::where('user_id',\auth()->id())->where('status',1)->sum('amount');
        $data['total_PendingWithdraw'] = WithdrawLog::where('user_id',\auth()->id())->where('status',0)->sum('amount');
        $data['total_fundTransfer'] = Transaction::where('user_id',\auth()->id())->where('status',2)->sum('amount');

        //this-month
        $investLogMonth = InvestLog::where('user_id',\auth()->id())->whereMonth('updated_at', Carbon::now()->month)->get();
        $data['month_withdraw'] = WithdrawLog::where('user_id',\auth()->id())->where('status',1)->whereMonth('updated_at', Carbon::now()->month)->sum('amount');
        $data['month_deposit'] = Deposit::where('user_id',\auth()->id())->where('status',1)->whereMonth('updated_at', Carbon::now()->month)->sum('amount');
        $data['month_earn'] = $this->totalEarn($investLogMonth);
        $data['month_fundTransfer'] = Transaction::where('user_id',\auth()->id())->whereMonth('updated_at', Carbon::now()->month)->where('status',2)->sum('amount');


        $data['page_title'] = "User Panel";
        return view('user.home',$data);
    }

    public function investIndex()
    {
        $data['page_title'] = "Investment Plans";
        $data['roi_plans'] = Plan::where('return_time_status',1)->get();
        $data['fixed_plans'] = Plan::where('return_time_status',0)->get();
        return view('user.invest.plan',$data);
    }

    public function purPlan(Request $request,$plan)
    {


        $plan = Plan::find($plan);
        $gnl = General::first();
        $me = Auth::user();
        if ($plan instanceof Plan){
            if ($plan->return_time_status == 1){
               try{
                   $request->validate([
                       'invest_amount' => 'required|numeric'
                   ]);
                   if ($me->balance < $request->invest_amount){
                       return back()->with('alert','Insufficient Balance');
                   }
                   if (($request->invest_amount >= $plan->min_amount) && $request->invest_amount <= $plan->max_amount){
                       //balance deduct start
                       $newBalance = floatval($me->balance) - floatval($request->invest_amount);
                       createTransaction('Balance deduct for purchasing '.$plan->name, $request->invest_amount,$me->balance,$newBalance,0);
                       $me->update([
                           'balance' => $newBalance
                       ]);
                       //balance deduct End
                       InvestLog::create([
                           'user_id' => $me->id,
                           'plan_name' => $plan->name,
                           'get_percent' => $plan->percent,
                           'get_action' => $plan->action,
                           'get_period' => $plan->period,
                           'took_action' => 0,
                           'invest_amount' => $request->invest_amount,
                           'status' => 0,
                           'next_time' => Carbon::now()->addHours($plan->period),
                       ]);
                       levelCommision($me->id ,$request->invest_amount);
                       return back()->with('success','Successfully purchased '.$plan->name);
                   }
                   return back()->with('alert','Min '.$plan->min_amount.$gnl->currency.' To '.$plan->max_amount.$gnl->currency.' required');
               }catch (\Exception $e){
                   return back()->with('alert',$e->getMessage());
               }
            }elseif ($plan->return_time_status == 0){
                try{
                    if ($me->balance < $plan->fixed_amount){
                        return back()->with('alert','Insufficient Balance');
                    }
                    //balance deduct start
                    $newBalance = floatval($me->balance) - floatval($plan->fixed_amount);
                    createTransaction('Balance deduct for purchasing '.$plan->name, $plan->fixed_amount,$me->balance,$newBalance,0);
                    $me->update([
                        'balance' => $newBalance
                    ]);
                    //balance deduct End
                    InvestLog::create([
                        'user_id' => $me->id,
                        'plan_name' => $plan->name,
                        'get_percent' => $plan->percent,
                        'get_action' => $plan->action,
                        'get_period' => $plan->period,
                        'took_action' => 0,
                        'invest_amount' => $plan->fixed_amount,
                        'status' => 0,
                        'next_time' => Carbon::now()->addHours($plan->period),
                    ]);
                    levelCommision($me->id ,$plan->fixed_amount);
                    return back()->with('success','Successfully purchased '.$plan->name);
                }catch (\Exception $e){
                    return back()->with('alert',$e->getMessage());
                }
            }
            return back()->with('alert','Purchase Failed, please try again');
        }
        return back()->with('alert','Purchase Failed, please try again');
    }

    public function profileIndex(){
        $data['page_title'] = "Profile";
        $data['user'] = Auth::user();
        return view('user.profile',$data);
    }

    public function profileUpdate(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'zip_code' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);
        try {
        Auth::user()->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'gender' => $request->gender,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'country' => $request->country,
        ]);
        return back()->with('success', 'Profile Update Successfully.');
        } catch (\Exception $e) {
            return back()->with('alert', $e->getMessage());
        }
    }

    public function passwordUpdate(Request $request){
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);
        try {
            $c_password = Auth::user()->password;
            $c_id = Auth::user()->id;
            $user = User::findOrFail($c_id);
            if (Hash::check($request->current_password, $c_password)) {
                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();

                return back()->with('success', 'Password Changes Successfully.');
            } else {
                return back()->with('alert', 'Current Password Not Match');
            }
        } catch (\Exception $e) {
            return back()->with('alert', $e->getMessage());
        }

    }

    public function depositLog(){
        $data['page_title'] = "Deposit Log";
        $data['deposits'] = Deposit::where('user_id',\auth()->id())->where('status','!=',0)->latest('updated_at')->with('deposit_request_table')->paginate();
        return view('user.deposit.log',$data);
    }

    public function investLog(){
        $data['page_title'] = "Invest Log";
        $data['plans'] = InvestLog::where('user_id',\auth()->id())->latest('updated_at')->paginate();
        return view('user.invest.log',$data);
    }

    public function transactionLog(){
        $data['page_title'] = "Transaction Log";
        $data['trans'] = Transaction::where('user_id',\auth()->id())->latest('updated_at')->paginate();
        return view('user.trans-log',$data);
    }

    public function fundTransIndex(){
        $data['page_title'] = "Fund-Transfer";
        return view('user.fund-trans',$data);
    }

    public function fundTransStore(Request $request){
        $request->validate([
           'email' => 'required|email',
           'amount' => 'required|numeric|min:0',
        ]);
        try {
            $gnl = General::first();
            $charge = ((floatval($request->amount) * floatval($gnl->bal_trans_percentage_charge)) / 100) + floatval($gnl->bal_trans_fixed_charge);
            $user = \auth()->user();
            $total = floatval($charge) + floatval($request->amount);
            if ($user->balance < $total) {
                return redirect()->back()->with('alert', 'Insufficient Balance');
            } else {
                $receiver = User::where('email', trim($request->email))->first();
                if ($receiver instanceof User) {
                    if (trim($request->email) == $user->email) {
                        return redirect()->back()->with('alert', 'Can not transfer own wallet');
                    }
                    //balance deduct from sender
                    $newBal = $user->balance - $total;
                    createTransaction("Transfer fund to " . $receiver->name, $request->amount, $user->balance, $newBal, 2);
                    $user->balance = $newBal;
                    $user->update();

                    //balance add to receiver
                    $nBal = $receiver->balance + $request->amount;
                    createTransaction("Fund Added from " . $user->name, $request->amount, $receiver->balance, $nBal, 2, $receiver->id);
                    $receiver->balance = $nBal;
                    $receiver->update();

                    return redirect()->back()->with('success', 'Amount Transfer Success');
                }
                return redirect()->back()->with('alert', 'User not found');
            }
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }



    public function withdrawIndex()
    {
        $data['page_title'] = "Withdraw-Methods";
        $data['gateways'] = WithdrawMethod::where('status', 1)->get();
        return view('user.withdraw.methods', $data);
    }


    public function withdrawLog()
    {
        $data['page_title'] = "Withdraw-log";
        $data['deposits'] = WithdrawLog::where('user_id',\auth()->id())->latest('updated_at')->paginate();
        return view('user.withdraw.log', $data);
    }

    public function withdrawPreview(Request $request)
    {
        $this->validate($request, [
            'gateway' =>'required',
            'amount' => 'required|numeric|min:1'
        ]);

        try {
            $amount = $request->amount;
            $method = WithdrawMethod::findOrFail($request->gateway);
            $charge = ((floatval($method->chargepc) * floatval($amount)) / 100) + $method->chargefx;
            $total = floatval($charge) + floatval($amount);

            if (($request->amount >= $method->min_amo) && ($request->amount <= $method->max_amo)) {
                if ($total <= Auth::user()->balance) {
                    $page_title = 'Preview';
                    return view('user.withdraw.preview', compact('method', 'amount', 'page_title'));
                }
                return redirect()->back()->with('alert', 'Insufficient balance');
            } else {
                return redirect()->back()->with('alert', 'Please follow withdraw limit');
            }
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }

    public function storeWithdraw(Request $request){
        $this->validate($request,[
            'amount' => 'required|numeric|min:0',
            'method_id' => 'required',
        ]);
        try {
            $amount = $request->amount;
            $method = WithdrawMethod::findOrFail($request->method_id);
            $charge = ((floatval($method->chargepc) * floatval($amount)) / 100) + floatval($method->chargefx);
            $total = floatval($charge) + floatval($amount);

            $me = Auth::user();
            if (($total <= $me->balance) && ($request->amount >= $method->min_amo) && ($request->amount <= $method->max_amo)) {
                $new_balance = floatval($me->balance) - floatval($total);
                createTransaction("Withdraw via " . $method->name, $total, $me->balance, $new_balance, 3);
                $me->balance = $new_balance;
                $me->update();
                $withdraw = WithdrawLog::create([
                    'amount' => $amount,
                    'charge' => $charge,
                    'method_name' => $method->name,
                    'processing_time' => $method->processing_day,
                    'detail' => $request->detail,
                    'method_rate' => $method->rate,
                    'method_cur' => $method->currency,
                    'withdraw_id' => rand(2222, 9999),
                    'user_id' => $me->id,
                    'status' => 0,
                ]);
                $general = General::first();
                $message = 'Welcome! Your Withdraw request is success, Please wait for processing days.Your Withdraw amount : ' . $withdraw->amount . $general->currency . '
         our current balance is ' . $new_balance . $general->symbol . ' .';
                send_email($me['email'], $me['name'], 'Successfully Withdraw', $message);
                return redirect()->route('home')->with('success', 'Withdraw Request Success, Wait for processing day');
            } else {
                return redirect()->route('user.withdraw.method')->with('alert', 'Insufficient balance');
            }
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }

    public function searchTrans(Request $request){
        $trans = Transaction::query();
        if (!is_null($request->trans_id)){
            $trans->where("trans_id","LIKE","%{$request->trans_id}%");
        }
        if (!is_null($request->type)){
            switch ($request->type){
                case "Invest":
                    $trans->where('status', 0);
                    break;
                case "Deposit":
                    $trans->where('status', 1);
                    break;
                case "Transfer":
                    $trans->where('status', 2);
                    break;
                case "Income":
                    $trans->where('status', 4);
                    break;
                case "Withdraw":
                    $trans->where('status', 3);
                    break;
                case "Referral":
                    $trans->where('status', 5);
                    break;
                default:
                    $trans->whereIn('status', [0,1,2,3,4,5]);
            }
        }
        $data['page_title'] = "Searched Transaction Log";
        $data['trans'] = $trans->where('user_id',\auth()->id())->latest('updated_at')->paginate(50);
        return view('user.trans-log',$data);
    }

    public function myRef($level = 1)
    {
        $data['page_title'] = "My Referral";

        // if($level == 1){
            $data['refUser'] = auth()->user()->refUser;
        // }

        // $ref = Referral::count();
        // $ar = auth()->user()->refUser()->pluck('id')->toArray();


        // for($i=0; $i < $ref; $i++){
        //     if($level == $i){
        //         $refrefUser = $this->getRef($ar);
        //         // $refrefUser = User::whereIn('ref_id',$ar)->get();
        //         array_replace($ar,$refrefUser->pluck('id')->toArray());

        //         $data['refUser'] = $this->getRef($ar);
        //     break;
        //     }



        //     // if($i == 1){
        //     //     $data['refUser'] = auth()->user()->refUser;
        //     //     array_push($ar,auth()->user()->refUser()->pluck('id')->toArray());
        //     // }

        //     // if($i == 2){

        //     //     dd($ar);
        //     //     // $data['refUser'] = $this->getRef(User::where('ref_id', $ar)->pluck('id')->toArray());
        //     //     // array_push($ar,$data['refUser']->pluck('id')->toArray());
        //     // }

        //     // if($i == 3){
        //     //     $data['refUser'] = $this->getRef(User::where('ref_id', [auth()->user()->refUser()->pluck('id')->toArray()])->pluck('id')->toArray());
        //     // }

        // }

        // return $data['refUser'];

        // return auth()->user()->refUser;


        return view('user.ref', $data);
    }

    public function getRef(array $ids){
        return User::whereIn('id',[$ids])->get();
    }

}
