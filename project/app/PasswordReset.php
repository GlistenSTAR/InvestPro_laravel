<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $guarded=['id'];
    protected $table = "password_resets";
}
