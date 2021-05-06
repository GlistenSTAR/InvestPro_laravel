<?php

use App\PaymentGatway;

function paypalCredential($index)
{
    $gw = PaymentGatway::first();
    return $gw->$index;
}


function createTransaction($message,$amount,$oldBalance,$newBalance,$status, $userID = null){
    $transId = substr(rand(0000,9999).time(),6);
    if (!is_null($userID)){
        $me = $userID;
    }else{
        $me = auth()->id();
    }

    return \App\Transaction::create([
       'user_id' =>$me,
       'trans_id' =>$transId,
       'description' =>$message,
       'amount' =>$amount,
       'old_bal' =>$oldBalance,
       'new_bal' =>$newBalance,
       'status' =>$status,
    ]);
}

function split_name($name) {
    $name = trim($name);
    $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
    $first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
    return array($first_name, $last_name);
}

function uploadImage($image,$location,$name = null,$extension = null,$resize = []){
    try{
        if ($name){
            $replaceName = $name;
        }else{
            $replaceName = uniqid().rand(111,999);
        }
        if ($extension){
            $filename = $replaceName.'.'.$extension;
        }else{
            $filename = $replaceName.'.'.$image->getClientOriginalExtension();
        }
        $destination = 'public/'.$location.'/'.$filename;
        $img = \Intervention\Image\Facades\Image::make($image);
        if (count($resize) > 0){
            $img->resize($resize[0],$resize[1]);
        }
        $img->save($destination);
        return $filename;
    }catch (Exception $e){
        return $e->getMessage();
    }
}


if (! function_exists('send_email')) {

    function send_email( $to, $name, $subject, $message)
    {
        $gnl = \App\General::first();
        $template = $gnl->email_template;
        $from = $gnl->esender;

        $headers = "From: $gnl->web_name <$from> \r\n";
        $headers .= "Reply-To: $gnl->web_name <$from> \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $mm = str_replace("{{name}}",$name,$template);
        $message = str_replace("{{message}}",$message,$mm);
        @mail($to, $subject, $message, $headers);

    }
}




function Replace($data) {
    $data = str_replace("'", "", $data);
    $data = str_replace("!", "", $data);
    $data = str_replace("@", "", $data);
    $data = str_replace("#", "", $data);
    $data = str_replace("$", "", $data);
    $data = str_replace("%", "", $data);
    $data = str_replace("^", "", $data);
    $data = str_replace("&", "", $data);
    $data = str_replace("*", "", $data);
    $data = str_replace("(", "", $data);
    $data = str_replace(")", "", $data);
    $data = str_replace("+", "", $data);
    $data = str_replace("=", "", $data);
    $data = str_replace(",", "", $data);
    $data = str_replace(":", "", $data);
    $data = str_replace(";", "", $data);
    $data = str_replace("|", "", $data);
    $data = str_replace("'", "", $data);
    $data = str_replace('"', "", $data);
    $data = str_replace("?", "", $data);
    $data = str_replace("  ", "_", $data);
    $data = str_replace("'", "", $data);
    $data = str_replace(".", "-", $data);
    $data = strtolower(str_replace("  ", "-", $data));
    $data = strtolower(str_replace(" ", "-", $data));
    $data = strtolower(str_replace(" ", "-", $data));
    $data = strtolower(str_replace("__", "-", $data));
    return str_replace("_", "-", $data);
}

function short_text($data,$length){
    $first_part = explode(" ",$data);
    $main_part = strip_tags(implode(' ',array_splice($first_part,0, $length)));
    return $main_part ."...." ;
}

function levelCommision($id, $amount){
    $usr = $id;
    $i = 1;
    $level = \App\Referral::count();
    while($usr!="" || $usr!="0" || $i<$level ) {
      $me = \App\User::find($usr);
      $refer= \App\User::find($me->ref_id);
        if($refer == "") {
            break;
        }
        $comission = \App\Referral::where('id',$i)->first();
        $com = ($amount * $comission->percentage)/100;
        $new_bal = $refer->balance +$com;
        $refer->balance = $new_bal;
        createTransaction('Congratulation, You Got '.$i.' Level Referral Commission from '.$refer->name, $com,$refer->balance,$new_bal,5,$refer->id);
        $refer->save();
        send_email($refer->email, $refer->name, 'Referral Commission', 'Congratulation, You Got '.$i.' Level Referral Commission from '.$refer->name);
        $usr = $refer->id;
        $i++;
    }
    return 0;
}

function showBelowUser($id){

    $level = \App\Referral::count();
    $under_ref = \App\User::where('ref_id',$id)->get();
    $print = array();
    $i = 2;
    foreach ($under_ref as $data) {
        $cc = \App\User::where('ref_id',$data->id)->count();
        $paaaa = \App\InvestLog::whereUserId($data->id)->whereStatus(1)->latest()->first();
        if (isset($paaaa)){
            $planName = $paaaa->plan_name;
        }else{
            $planName = __('Not Subscript');
        }
        echo "<li class=\"container\">";
        echo '<h6 style="color: #0b0b0b; font-weight: bold"> <span class="badge badge-dark">'. $print[] = $data->name .' : <code>( Joining Date: '.\Carbon\Carbon::parse($data->created_at)->format('Y-m-d').')( Plan : '.$planName.')</code> </span></h6>';

        if($cc>0){
            echo '<ul>';
            echo '<li class="container">';
            echo '<h6 style="color: #0b0b0b; font-weight: bold">'. $print[] =  showBelowUser($data->id) .'</h6>';
            echo '</li>';
            echo '</ul>';
        }
        echo "</li>";
        $i++;
    }
}
