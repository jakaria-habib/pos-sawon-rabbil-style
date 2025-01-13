<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    protected $fillable = ['total','discount','vat','payable','customer_id','user_id'];

    function customer():BelongsTo{
        return $this->belongsTo(Customer::class);
    }

}
