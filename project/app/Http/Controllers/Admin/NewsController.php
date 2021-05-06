<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function workIndex(){
        $works = News::all();
        return view('admin.news.index',compact('works'));
    }

    public function workCreate(){
        return view('admin.news.create');
    }

    public function workStore(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'sometimes|mimes:jpeg,png,bmp,gif,svg|max:1024'
        ]);
        try{

            $fileName = uploadImage($request->file('image'),'images/news');
            News::create([
                'image' => $fileName,
                'title' => $request->title,
                'description' => $request->description,
            ]);
            return back()->with('success','Create Successfully');
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }

    public function workEdit(News $workArea){
        return view('admin.news.edit',compact('workArea'));
    }

    public function workUpdate(Request $request, News $workArea){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'sometimes|mimes:jpeg,png,bmp,gif,svg|max:1024'
        ]);
        try{
            if ($request->file('image')){
                @unlink('public/images/news/'.$workArea->image);
                $fileName = uploadImage($request->file('image'),'images/news');
            }else{
                $fileName = $workArea->image;
            }
            $workArea->update([
                'image' => $fileName,
                'title' => $request->title,
                'description' => $request->description,
            ]);
            return back()->with('success','Update Successfully');
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }

    public function workDelete(News $workArea){
        try{
            @unlink('public/images/news/'.$workArea->image);
            $workArea->delete();
            return back()->with('success','Delete Successfully');
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }
}
