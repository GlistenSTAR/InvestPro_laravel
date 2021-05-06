<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentGatway extends Model
{
    protected $guarded = ['id'];


    public function deposit()
    {
        return $this->hasMany('App\Deposit','id','gateway_id');
    }
}
