<?php

namespace App\Http\Controllers\Admin;

use App\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function bannerIndex(){
        return view('admin.general.banner');
    }

    public function aboutIndex(){
        return view('admin.general.about');
    }

    public function logoIcon(){
        return view('admin.general.logo-icon');
    }

    public function generalStore(Request $request){
        $gnl = General::first();

       
        try{
            foreach ($request->all() as $key => $file){
                if ($key != '_token'){
                    $textInputFiledName[] = $key;
                }
            }
            if ($request->file()){
                foreach ($request->file() as $key => $file){
                    if ($key != '_token'){
                        $fileInputFiledName[] = $key;
                    }
                }
            }else{
                $fileInputFiledName = array();
            }
            foreach ($request->except($fileInputFiledName) as $key => $data){
                if ($key != '_token'){
                    $gnl->$key = $data;
                    $gnl->update();
                }
            }
            if ($request->hasFile('banner_bg_image')){
                $request->validate([
                    'banner_bg_image' => 'sometimes|mimes:jpeg,png,bmp,gif,svg|max:2024'
                ]);
                uploadImage($request->file('banner_bg_image'),'images/banner','bg','png');
            }
            if ($request->hasFile('banner_front_image')){
                $request->validate([
                    'banner_front_image' => 'sometimes|mimes:jpeg,png,bmp,gif,svg|max:2024'
                ]);
                uploadImage($request->file('banner_front_image'),'images/banner','front','png');
            }

            if ($request->hasFile('single_about1_icon')){
                $request->validate([
                    'single_about1_icon' => 'sometimes|mimes:jpeg,png,bmp,gif,svg|max:2024'
                ]);
                uploadImage($request->file('single_about1_icon'),'images/about','one','png');
            }

            if ($request->hasFile('single_about2_icon')){
                $request->validate([
                    'single_about2_icon' => 'sometimes|mimes:jpeg,png,bmp,gif,svg|max:2024'
                ]);
                uploadImage($request->file('single_about2_icon'),'images/about','two','png');
            }

            if ($request->hasFile('logo')){
                $request->validate([
                    'logo' => 'sometimes|mimes:jpeg,png,bmp,gif,svg|max:2024'
                ]);
                

                uploadImage($request->file('logo'),'images/logo','logo','png');
            }

            if ($request->hasFile('favicon')){
                $request->validate([
                    'favicon' => 'sometimes|mimes:jpeg,png,bmp,gif,svg|max:2024'
                ]);
                uploadImage($request->file('favicon'),'images/logo','favicon','png');
            }

            if ($request->hasFile('bread_front_image')){
                $request->validate([
                    'bread_front_image' => 'sometimes|mimes:jpeg,png,bmp,gif,svg|max:2024'
                ]);
                uploadImage($request->file('bread_front_image'),'images/banner','bred','png');
            }
            return back()->with('success','Updated Successfully');
        }catch (\Exception $e){
            return back()->with('alert',$e->getMessage());
        }
    }
}
