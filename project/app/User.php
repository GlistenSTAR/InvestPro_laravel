<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function refUser()
    {
        return $this->hasMany(User::class, 'ref_id');
    }

    public function investLog()
    {
        return $this->hasMany(InvestLog::class, 'user_id');
    }

    // public function mylevel(){

    //     if(count($this->getRef(auth()->user()->refUser()->pluck('id')->toArray())) > 0){
    //         $i = 0
    //         while (1){ //infinite loop

    //             if($this->getRef(auth()->user()->refUser()->pluck('id')->toArray())) break; //it will break when condition is true
    //         }
    //     }

    //     for($i = 0;$i <100; $i++){

    //     }

    //     $this->getRef(auth()->user()->refUser()->pluck('id')->toArray());
    // }

    // public function getRef(array $ids){
    //     return User::where('id',[$ids])->get();
    // }
}
