<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PaymentGatway;
use Illuminate\Http\Request;
use App\Gateway;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class GatewayController extends Controller
{
    public function show()
    {
        	$gateways = PaymentGatway::all();
        	$page_title = "Gateway";
        	return view('admin.deposit.gateway', compact('gateways','page_title'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rate' => 'required|numeric',
            'image' => 'mimes:jpeg,jpg,png',
            'minimum_deposit_amount' => 'required|numeric',
            'maximum_deposit_amount' => 'required|numeric',
            'fixed_charge' => 'required|numeric',
            'percentage_charge' => 'required|numeric',
            'gateway_key_one' => 'sometimes|required',
            'gateway_key_two' => 'sometimes|required',
            'gateway_key_three' => 'sometimes|required',
            'gateway_key_four' => 'sometimes|required',
            'status' => 'required',
        ]);
        $gatewayID = $request->id;
        try{
            $data = $request->except('_token','id');
            $gateway = PaymentGatway::find($gatewayID);
            if($request->hasFile('image')) {
                @unlink('images/gateway/'.$gateway->image);
                $image = $request->file('image');
                $fileName = time(). '.jpg';
                $location = 'public/images/gateway/' . $fileName;
                Image::make($image)->resize(800, 800)->save($location);
                $data['image'] = $fileName;
            }
            $gateway->update($data);
            Session::flash('success', $gateway->name.' updated successfully!');
            return back();
        }catch (\Exception $e){
            return back()->withErrors([$e->getMessage()]);
        }
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'rate' => 'required|numeric',
            'image' => 'mimes:jpeg,jpg,png',
            'minimum_deposit_amount' => 'required|numeric',
            'maximum_deposit_amount' => 'required|numeric',
            'fixed_charge' => 'required|numeric',
            'percentage_charge' => 'required|numeric',
            'gateway_key_one' => 'sometimes|required',
            'gateway_key_two' => 'sometimes|required',
            'gateway_key_three' => 'sometimes|required',
            'gateway_key_four' => 'sometimes|required',
            'status' => 'required',
        ]);
        try{
            $data = $request->except('_token');
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = time(). '.jpg';
                $location = 'public/images/gateway/' . $fileName;
                Image::make($image)->resize(800, 800)->save($location);
                $data['image'] = $fileName;
            }
            PaymentGatway::create($data);
            Session::flash('success', 'Gateway added successfully');
            return back();
        }catch (\Exception $e){
            return back()->withErrors([$e->getMessage()]);
        }
    }
}
