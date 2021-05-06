<?php

namespace App\Http\Controllers\Admin;

use App\Deposit;
use App\Http\Controllers\Controller;
use App\InvestLog;
use App\News;
use App\Plan;
use App\Referral;
use App\Transaction;
use App\User;
use App\WithdrawLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function adminIndex(){

        $data['total_user'] = User::count();
        $data['total_user_mon'] = User::whereMonth('created_at',Carbon::now()->month)->count();

        $data['total_ac_user'] = User::where('status',1)->count();
        $data['total_ac_user_month'] = User::where('status',1)->whereMonth('created_at',Carbon::now()->month)->count();

        $data['total_bn_user'] = User::where('status',0)->count();
        $data['total_bn_user_month'] = User::where('status',0)->whereMonth('created_at',Carbon::now()->month)->count();

        $data['total_deposit'] = Deposit::where('status',1)->sum('amount');
        $data['total_deposit_month'] = Deposit::where('status',1)->whereMonth('updated_at',Carbon::now()->month)->sum('amount');

        $data['total_withdraw'] = WithdrawLog::where('status',1)->sum('amount');
        $data['total_withdraw_month'] = WithdrawLog::where('status',1)->whereMonth('updated_at',Carbon::now()->month)->sum('amount');

        $data['total_invest'] = InvestLog::sum('invest_amount');
        $data['total_invest_month'] = InvestLog::whereMonth('created_at',Carbon::now()->month)->sum('invest_amount');

        $data['roi_plans'] = Plan::where('return_time_status',1)->get();
        $data['fixed_plans'] = Plan::where('return_time_status',0)->get();

        $data['investLog'] = InvestLog::latest('updated_at')->paginate();

        $data['latestNews'] = News::latest('updated_at')->take(5)->get();
        return view('admin.home',$data);
    }

    public function gnlSetting(){
        return view('admin.general.settings');
    }

    public function indexEmail(){
        return view('admin.general.email');
    }

    public function adminLogout(){
        Auth::guard('admin')->logout();
        return redirect('/admin')->with('success','Logout successfully');
    }

    public function usersIndex()
    {
        $user = User::latest('id')->paginate(30);
        return view('admin.user.index', compact('user'));
    }

    public function transactionIndex()
    {
        $trans = Transaction::latest('id')->paginate(30);
        return view('admin.trans-log', compact('trans'));
    }

    public function usersActiveIndex()
    {
        $user = User::whereStatus(1)->latest('id')->paginate(30);
        return view('admin.user.index', compact('user'));
    }

    public function usersBanndedIndex()
    {
        $user = User::whereStatus(0)->latest('id')->paginate(30);
        return view('admin.user.index', compact('user'));
    }

    public function userSearch(Request $request)
    {
        $user = User::where('name', 'LIKE',"%{$request->username}%")->paginate();
        return view('admin.user.index', compact('user'));
    }

    public function userSearchEmail(Request $request)
    {
        $user = User::where('email','LIKE',"%{$request->email}%")->paginate();
        return view('admin.user.index', compact('user'));
    }

    public function indexUserDetail($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.view',compact('user'));
    }

    public function userUpdate(Request $request ,$id)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->back()->with('success','Successfully Updated');
    }

    public function indexUserBalance($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.balance',compact('user'));
    }

    public function indexBalanceUpdate(Request $request ,$id)
    {
        $this->validate($request,[
            'amount' => 'required|numeric|min:0',
            'operation' => 'required',
        ]);
        $user = User::find($id);
        if ($user instanceof User){
            if ($request->operation == 1){
                $new_balance = $user->balance + $request->amount;
                createTransaction("Balance added via admin", $request->amount,$user->balance,$new_balance,1, $user->id);
                $user->balance = $new_balance;
                $user->update();
                if (!is_null($request->message)){
                    send_email($user->email, $user->name ,"Fund Added", $request->message);
                }
                return back()->with('success','Balance Add Successful');
            }else{
                if ($user->balance >= $request->amount){
                    $new_balance = $user->balance - $request->amount;
                    createTransaction("Balance deduct via admin", $request->amount,$user->balance,$new_balance,1, $user->id);
                    $user->balance = $new_balance;
                    $user->update();
                    if (!is_null($request->message)){
                        send_email($user->email, $user->name ,"Fund deduct", $request->message);
                    }
                    return back()->with('success','Balance Subtract Successful');
                }
                return back()->with('alert','Insufficient Balance.');
            }
        }
        return back()->with('alert','User not found.');
    }

    public function userSendMail($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.user_mail',compact('user'));
    }

    public function userSendMailUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $subject =$request->subject;
        $message = $request->message;
        send_email($user->email, $user->name ,$subject, $message);
        return back()->with('success','Mail Send');
    }

    public function changePass() {
        return view('admin.pass_change');
    }


    public function updatePassword(Request $request) {
        $request->validate( [
            'name' => 'required',
            'email' => 'required|email',
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        // if given old password matches with the password of this authenticated user...
        if(Hash::check($request->current_password, Auth::guard('admin')->user()->password)) {
            // updating password in database...
            $user = auth()->guard('admin')->user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return back()->with('success','Profile update successful');
        }
        return back()->with('alert','Old password not matched');
    }

    public function searchResult(Request $request)
    {
        $trans = Transaction::query();
        if (!is_null($request->trans_id)){
            $trans->where("trans_id","LIKE","%{$request->trans_id}%");
        }
        if (!is_null($request->user)){
            $u = $request->user;
            $trans->whereHas('user',function ($q) use ($u){
                $q->where('name',"LIKE","%{$u}%");
            });
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
        $trans = $trans->latest('id')->paginate(50);
        return view('admin.trans-log', compact('trans'));
    }

    public function referralIndex() {
        $ref = Referral::all();
        $lastRef = Referral::orderBy('id','desc')->first();

         return view('admin.referral.index',compact('ref','lastRef'));
    }

    public function referralStore(Request $request){
        if(count($request->percentage) == 0){
            return back()->with('alert','Percentage field is required');
        }
        try{
            foreach($request->percentage as $data){
                if(!is_null($data)){
                    if(!is_numeric($data)) return back()->with('alert','Please insert numeric value.');
                }

            }
            Referral::truncate();
        foreach($request->percentage as $data){
            Referral::create([
                'percentage' => $data
            ]);
        }
        return back()->with('success','Referral Percentage Commission generated.');
        }catch(\Exception $e){
            return back()->with('success','Referral Percentage Commission generated.');
        }
    }
}
