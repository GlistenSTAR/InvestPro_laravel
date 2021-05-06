<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\WorkArea;
use Illuminate\Http\Request;

class WorkAreaController extends Controller
{
    public function workIndex(){
        $works = WorkArea::all();
        return view('admin.work-area.index',compact('works'));
    }

    public function workCreate(){
        return view('admin.work-area.create');
    }

    public function workStore(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'icon' => 'sometimes|mimes:jpeg,png,bmp,gif,svg|max:1024'
        ]);
        try{
            $fileName = uploadImage($request->file('icon'),'images/work');
            WorkArea::create([
                'icon' => $fileName,
                'title' => $request->title,
                'description' => $request->description,
            ]);
            return back()->with('success','Create Successfully');
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }

    public function workEdit(WorkArea $workArea){
        return view('admin.work-area.edit',compact('workArea'));
    }

    public function workUpdate(Request $request, WorkArea $workArea){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'icon' => 'sometimes|mimes:jpeg,png,bmp,gif,svg|max:1024'
        ]);
        try{
            if ($request->file('icon')){
                @unlink('public/images/work/'.$workArea->icon);
                $fileName = uploadImage($request->file('icon'),'images/work');
            }else{
                $fileName = $workArea->icon;
            }
            $workArea->update([
                'icon' => $fileName,
                'title' => $request->title,
                'description' => $request->description,
            ]);
            return back()->with('success','Update Successfully');
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }

    public function workDelete(WorkArea $workArea){
        try{
        @unlink('public/images/work/'.$workArea->icon);
        $workArea->delete();
        return back()->with('success','Delete Successfully');
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }
}
