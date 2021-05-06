<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Investor;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    public function workIndex(){
        $works = Investor::all();
        return view('admin.investor.index',compact('works'));
    }

    public function workCreate(){
        return view('admin.investor.create');
    }

    public function workStore(Request $request){

        $request->validate([
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'fb_link' => 'sometimes|max:255',
            'twitter_link' => 'sometimes|max:255',
            'linkedin_link' => 'sometimes|max:255',
            'image' => 'sometimes|mimes:jpeg,png,bmp,gif,svg|max:1024',
        ]);
        try{
            $fileName = uploadImage($request->file('image'),'images/investor');
            Investor::create([
                'image' => $fileName,
                'name' => $request->name,
                'designation' => $request->designation,
                'fb_link' => $request->fb_link,
                'twitter_link' => $request->twitter_link,
                'linkedin_link' => $request->linkedin_link,
            ]);
            return back()->with('success','Create Successfully');
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }

    public function workEdit(Investor $workArea){
        return view('admin.investor.edit',compact('workArea'));
    }

    public function workUpdate(Request $request, Investor $workArea){
        $request->validate([
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'fb_link' => 'sometimes|max:255',
            'twitter_link' => 'sometimes|max:255',
            'linkedin_link' => 'sometimes|max:255',
            'image' => 'sometimes|mimes:jpeg,png,bmp,gif,svg|max:1024',
        ]);
        try{
            if ($request->file('image')){
                @unlink('public/images/investor/'.$workArea->image);
                $fileName = uploadImage($request->file('image'),'images/investor');
            }else{
                $fileName = $workArea->image;
            }
            $workArea->update([
                'image' => $fileName,
                'name' => $request->name,
                'designation' => $request->designation,
                'fb_link' => $request->fb_link,
                'twitter_link' => $request->twitter_link,
                'linkedin_link' => $request->linkedin_link,
            ]);
            return back()->with('success','Update Successfully');
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }

    public function workDelete(Investor $workArea){
        try{
            @unlink('public/images/investor/'.$workArea->image);
            $workArea->delete();
            return back()->with('success','Delete Successfully');
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }
}
