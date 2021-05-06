<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositRequest extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function gateway() {
        return $this->belongsTo(PaymentGatway::class,'gateway_id')->withDefault();
    }
}
