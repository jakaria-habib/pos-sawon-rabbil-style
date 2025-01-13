<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [ 'email', 'first_name', 'last_name', 'mobile', 'password','otp'];

    protected $attributes = ['otp' => 0];


}
