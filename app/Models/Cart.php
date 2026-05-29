<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'size',
        'color',
        'price',
        'session_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    // Relationship to product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Get total price for this item
    public function getTotalPrice()
    {
        return $this->price * $this->quantity;
    }
}