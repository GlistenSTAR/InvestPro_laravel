<?php

namespace App\Http\Controllers\Admin;

use App\General;
use App\Http\Controllers\Controller;
use App\User;
use App\WithdrawLog;
use App\WithdrawMethod;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class WithDrawMethodController extends Controller
{
    public function indexWithdraw()
    {
        $withdraw = WithdrawMethod::all();
        return view('admin.withdraw.add_withdraw_method', compact('withdraw'));
    }

    public function storeWithdraw(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'required|image',
            'min_amo' => 'required|numeric|min:0',
            'max_amo' => 'required|numeric|min:0',
            'chargefx' => 'required|numeric|min:0',
            'chargepc' => 'required|numeric|min:0',
            'rate' => 'required|numeric|min:0',
            'processing_day' => 'required',
        ]);
        $withdraw = WithdrawMethod::create($request->all());
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . 'jpg';
            $location = 'public/images/withdraw_methods/'. $filename;
            Image::make($image)->save($location);
            $withdraw->image =  $filename;
            $withdraw->save();
        }
        return back()->with('success','Created Payment Method Successfully');
    }

    public function updateWithdraw(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'mimes:jpg,jpeg,png,svg',
            'min_amo' => 'required|numeric|min:1',
            'max_amo' => 'required|numeric|min:1',
            'chargefx' => 'required',
            'chargepc' => 'required',
            'rate' => 'required',
            'currency' => 'required',
            'processing_day' => 'required',
            'status' => 'required',
        ]);
        WithdrawMethod::whereId($id)
            ->update([
                'name' => $request->name,
                'min_amo' => $request->min_amo,
                'max_amo' => $request->max_amo,
                'chargefx' => $request->chargefx,
                'chargepc' => $request->chargepc,
                'rate' => $request->rate,
                'currency' => $request->currency,
                'processing_day' => $request->processing_day,
                'status' => $request->status,
            ]);
        $general = WithdrawMethod::findOrFail($id);
        if ($request->hasFile('image')) {
            @unlink('public/images/withdraw_methods/'.$general->image);
            $image = $request->file('image');
            $filename = time() . '.' . 'jpg';
            $location = 'public/images/withdraw_methods/'. $filename;
            Image::make($image)->save($location);
            $general->image =  $filename;
            $general->save();
        }
        return back()->with('success','Updated Payment Method Successfully');
    }

    public function requestWithdraw()
    {
        $withdraw = WithdrawLog::orderBy('id', 'desc')->where('status', 0)->paginate(15);
        return view('admin.withdraw.withdraw_request', compact('withdraw'));
    }

    public function detailWithdraw($id)
    {
        $data = WithdrawLog::findOrFail($id);
        return view('admin.withdraw.withdraw_detal', compact('data'));
    }

    public function repondWithdraw(Request $request, $id)
    {
        $this->validate($request,[
            'message' => 'required',
        ]);
        $withdraw = WithdrawLog::find($id);
        if ( $withdraw instanceof  WithdrawLog){
            $withdraw->status = $request->status;
            $withdraw->update();
            $user = $withdraw->user;
            if ($request->status == 1 ) {
                $message = $request->message;
                send_email($user['email'], $user->name, 'Withdraw Request Accept' , $message);
                return back()->with('success','Paid Complete');
            }else{
                $withdraw->user()->update([
                    'balance' => floatval($user->balance) + floatval($withdraw->amount) + floatval($withdraw->charge)
                ]);
                $message = $request->message;
                send_email($user['email'] ,$user->name, 'Withdraw Request Refund', $message);
                return back()->with('success','Refund Complete');
            }
        }

        return back()->with('alert','Log not found');
    }
    public function showWithdrawLog()
    {
        $withdraw = WithdrawLog::latest('updated_at')->paginate();
        return view('admin.withdraw.view_log', compact('withdraw'));
    }
}
