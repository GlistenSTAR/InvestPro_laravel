<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function workIndex(){
        $works = Menu::all();
        return view('admin.menu.index',compact('works'));
    }

    public function workCreate(){
        return view('admin.menu.create');
    }

    public function workStore(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);
        try{
            Menu::create([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            return back()->with('success','Create Successfully');
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }

    public function workEdit(Menu $workArea){
        return view('admin.menu.edit',compact('workArea'));
    }

    public function workUpdate(Request $request, Menu $workArea){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);
        try{
            $workArea->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            return back()->with('success','Update Successfully');
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }

    public function workDelete(Menu $workArea){
        try{
            $workArea->delete();
            return back()->with('success','Delete Successfully');
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }
}
