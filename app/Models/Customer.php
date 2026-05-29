<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'total_spent',
        'total_owed',
    ];

    protected $casts = [
        'total_spent' => 'decimal:2',
        'total_owed' => 'decimal:2',
    ];

    // Get customer's purchase history
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    // Get customer's credit details
    public function credits()
    {
        return $this->sales()->where('payment_method', 'credit')->whereIn('status', ['unpaid', 'partial']);
    }
}