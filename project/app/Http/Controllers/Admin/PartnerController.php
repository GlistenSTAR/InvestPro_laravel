<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Partners;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function workIndex(){
        $works = Partners::all();
        return view('admin.partners.index',compact('works'));
    }

    public function workStore(Request $request){

        $request->validate([
            'image' => 'sometimes|mimes:jpeg,png,bmp,gif,svg|max:1024',
        ]);
        try{
            $fileName = uploadImage($request->file('image'),'images/partner');
            Partners::create([
                'image' => $fileName,
            ]);
            return back()->with('success','Create Successfully');
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }

    public function workUpdate(Request $request, Partners $workArea){
        $request->validate([
            'image' => 'sometimes|mimes:jpeg,png,bmp,gif,svg|max:1024',
        ]);
        try{
            if ($request->file('image')){
                @unlink('public/images/partner/'.$workArea->image);
                $fileName = uploadImage($request->file('image'),'images/partner');
            }else{
                $fileName = $workArea->image;
            }
            $workArea->update([
                'image' => $fileName,
            ]);
            return back()->with('success','Update Successfully');
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }

    public function workDelete(Partners $workArea){
        try{
            @unlink('public/images/partner/'.$workArea->image);
            $workArea->delete();
            return back()->with('success','Delete Successfully');
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }
}
