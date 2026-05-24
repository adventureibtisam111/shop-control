<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'item_name',
        'selling_price',
        'cost_price',
        'quantity',
        'payment_method',
        'customer_name',
        'remaining_balance',
        'amount_owed',
        'status',
        'last_payment_at',
    ];
}