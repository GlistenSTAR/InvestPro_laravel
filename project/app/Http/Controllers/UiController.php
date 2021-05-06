<?php

namespace App\Http\Controllers;

use App\General;
use App\InvestLog;
use App\Investor;
use App\Menu;
use App\News;
use App\Partners;
use App\Plan;
use App\Service;
use App\User;
use App\WorkArea;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UiController extends Controller
{
    public function index(){

        $data['workAreaFirst'] = WorkArea::first();
        $data['workArea'] = WorkArea::where('id','!=',$data['workAreaFirst']['id'])->get();
        $data['services'] = Service::get();
        $data['investors'] = Investor::get();
        $data['partners'] = Partners::get();
        $data['news'] = News::get();
        $data['roi_plans'] = Plan::where('return_time_status',1)->get();
        $data['fixed_plans'] = Plan::where('return_time_status',0)->get();
        return view('front.index',$data);
    }

    public function newsIndex(){
        $data['news'] = News::latest('updated_at')->paginate(6);
        $data['page_title'] = "All News";
        return view('front.news',$data);
    }

    public function contactsIndex(){
        $data['page_title'] = "Contact-us";
        return view('front.contact',$data);
    }

    public function singlePage($class = null, $id = null){

        if (!is_null($class)){
            try{
                $gnl = General::first();
                if ($class == 'News'){
                    $news = News::findOrFail($id);
                    $data['image'] = asset('images/news/'.$news->image);
                    $data['title'] = $news->title;
                    $data['description'] = $news->description;
                    $data['updated_at'] = $news->updated_at;
                    $data['page_title'] = "News";
                }elseif ($class == 'Work'){
                    $work = WorkArea::findOrFail($id);
                    $data['image'] = asset('images/work/'.$work->icon);
                    $data['title'] = $work->title;
                    $data['description'] = $work->description;
                    $data['updated_at'] = $work->updated_at;
                    $data['page_title'] = "Work Area";
                }elseif ($class == 'About1'){
                    $data['title'] = $gnl->single_about1_title;
                    $data['description'] = $gnl->single_about1_description;
                    $data['page_title'] = 'Details';
                }elseif ($class == 'About2'){
                    $data['title'] = $gnl->single_about2_title;
                    $data['description'] = $gnl->single_about2_description;
                    $data['page_title'] = 'Details';
                }elseif ($class == 'About'){
                    $data['title'] = $gnl->about_title;
                    $data['description'] = $gnl->about_body;
                    $data['page_title'] = $gnl->about_head;
                }elseif ($class == 'Menu'){
                    $menu = Menu::findOrFail($id);
                    $data['title'] = $menu->title;
                    $data['description'] = $menu->description;
                    $data['updated_at'] = $menu->updated_at;
                    $data['page_title'] = $menu->title .' Details';
                }else{
                    return back()->with('alert','No Data found');
                }
                $data['recentPost'] = News::latest('updated_at')->take(6)->get();
                return view('front.single',$data);

            }catch (\Exception $e){
                return back()->with('alert','No Data found');
            }
        }
        return back()->with('alert','No Data found');
    }

    public function cronAction(){
        $general = General::first();
        $lend = InvestLog::where('status',0)->where('next_time', '<', Carbon::now())->cursor();
        foreach ($lend as $data){
            if ((is_null($data->get_action)) || ($data->get_action > $data->took_action)){
                $data->took_action = $data->took_action +1;
                $data->next_time = Carbon::now()->addHours($data->get_period);

                if ($data->user){
                $user = User::find($data->user->id);
                $payable = (floatval($data->invest_amount) * floatval($data->get_percent))/100;
                $newBal = floatval($user->balance) + floatval($payable);
                createTransaction("Return Of Invest : ".$data->plan_name,$payable, $user->balance, $newBal, 4,$data->user_id);
                $user->balance = $newBal;
                $user->update();
                $message =' Congratulation, Money back. '.$payable. $general->currency.' added your balance. And your current balance is '.$newBal. $general->currency.'. Please check for sure.';
                send_email($user->email, $user->name ,"Return Of Invest : ".$data->plan_name, $message);
            }
            
            }else{
                $data->status = 1;
            }
            $data->update();
            
        }
    }


}
