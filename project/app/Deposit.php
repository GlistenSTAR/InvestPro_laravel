<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $table = 'deposits';
    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function deposit_request_table()
    {
        return $this->hasOne(DepositRequest::class,'trx', 'trx');
    }

    public function gateway() {
        return $this->belongsTo(PaymentGatway::class,'gateway_id')->withDefault();
    }

}
