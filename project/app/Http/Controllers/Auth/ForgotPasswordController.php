<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\User;
use App\PasswordReset as PS;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showEmailForm() {
        return view('user.auth.passwords.email');
    }

    public function sendResetPassMail(Request $request)
    {
        $this->validate($request,[
            'resetEmail' => 'required',
        ]);
        $emp = User::where('email', $request->resetEmail)->first();
        if ($emp == null){
            return back()->with('alert', 'Email Not Available');
        }else{
            $to =$emp->email;
            $name = $emp->name;
            $subject = 'Password Reset';
            $code = Str::random(30);
            $message = 'Use This Link to Reset Password: '.url('/').'/reset/'.$code;
            DB::table('password_resets')->insert(
                ['email' => $to, 'token' => $code, 'status' => 0, 'created_at' => date("Y-m-d h:i:s")]
            );
            send_email($to, $name, $subject, $message);
            return back()->with('success', 'Password Reset Email Sent Successfully');

        }

    }

    public function resetPasswordForm($code) {
        $ps = PS::where('token', $code)->first();

        if ($ps == null) {
            return redirect()->route('user.showEmailForm');
        } else {
            if ($ps->status == 0) {
                $emp = User::where('email', $ps->email)->first();
                $data['email'] = $emp->email;
                $data['code'] = $code;
                return view('user.auth.passwords.reset', $data);
            } else {
                return redirect()->route('user.showEmailForm');
            }
        }
    }

    public function resetPassword(Request $request) {
        $messages = [
            'password_confirmation.confirmed' => 'Password does not match'
        ];

        $validatedData = $request->validate([
            'password' => 'required|confirmed',
        ], $messages);

        $emp = User::where('email', $request->email)->first();
        $emp->password = Hash::make($request->password);
        $emp->save();

        $ps = PS::where('token', $request->code)->first();
        $ps->status = 1;
        $ps->save();

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('home');
        }
    }
}
