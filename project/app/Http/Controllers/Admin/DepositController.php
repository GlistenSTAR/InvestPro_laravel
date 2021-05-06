<?php

namespace App\Http\Controllers\Admin;

use App\General;
use App\Http\Controllers\Controller;
use App\DepositRequest as DR;
use App\Deposit;
use App\PaymentGatway;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class DepositController extends Controller
{
    public function pending() {
        $data['deposits'] = DR::where('accepted', 0)->latest()->paginate(9);
        $data['page_title'] = 'Pending Request';
        return view('admin.deposit.requests', $data);
    }

    public function acceptedRequests() {
        $data['deposits'] = DR::where('accepted', 1)->latest()->paginate(9);
        $data['page_title'] = 'Accepted Request';
        return view('admin.deposit.requests', $data);
    }

    public function rejectedRequests() {
        $data['deposits'] = DR::where('accepted', -1)->latest()->paginate(9);
        $data['page_title'] = 'Rejected Request';
        return view('admin.deposit.requests', $data);
    }

    public function showReceipt() {
        $dID = $_GET['dID'];
        $deposit = DR::find($dID);
        return $deposit;
    }

    public function accept(Request $request) {
        try{
            $gs = General::first();
            $gt= PaymentGatway::find($request->gid);
            $dr = DR::find($request->dID);

            $dr->accepted = 1;
            $dr->save();
            $emp = User::find($dr->user_id);
            $newBalance = $emp->balance + $dr->amount;
            createTransaction('Deposit via '.$gt->name, $dr->amount,$emp->balance,$newBalance,1,$emp->id);
            $emp->balance = $newBalance;
            $emp->save();

            $message = $dr->amount . ' ' . $gs->currency . ' has been added to you to account balance';
            send_email($emp->email, $emp->name, "Deposit request accepted", $message);
            Session::flash('success', 'Request has been accepted successfully');
            return redirect()->back();
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }

    public function depositLog() {
        $data['deposits'] = Deposit::latest()->paginate(9);
        return view('admin.deposit.deposits', $data);
    }

    public function rejectReq(Request $request) {
        try{
            $gs = General::first();
            $dr = DR::find($request->dID);
            $dr->accepted = -1;
            $dr->save();
            $emp = User::find($dr->user_id);
            $message = "Your deposit request of " . $dr->amount . " " . $gs->currency . " has been rejected";
            send_email($emp->email, $emp->name, "Deposit request rejected", $message);
            Session::flash('success', 'Request has been rejected');
            return redirect()->back();
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }

    }
}
