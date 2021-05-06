<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function workIndex(){
        $works = Social::all();
        return view('admin.social.index',compact('works'));
    }

    public function workStore(Request $request){

        $request->validate([
           'icon' => 'required|max:255',
           'link' => 'required|url|max:255',
        ]);

        try{
            Social::create([
                'icon' => strtolower($request->icon),
                'link' => $request->link,
            ]);
            return back()->with('success','Create Successfully');
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }

    public function workUpdate(Request $request, Social $workArea){
        $request->validate([
            'icon' => 'required|max:255',
            'link' => 'required|url|max:255',
        ]);
        try{
            $workArea->update([
                'icon' => strtolower($request->icon),
                'link' => $request->link,
            ]);
            return back()->with('success','Update Successfully');
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }

    public function workDelete(Social $workArea){
        try{
            $workArea->delete();
            return back()->with('success','Delete Successfully');
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }
}
