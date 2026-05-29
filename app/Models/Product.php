<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'selling_price',
        'cost_price',
        'quantity',
        'category',
        'size',
        'color',
        'sku',
        'image',
        'is_active',
    ];

    protected $casts = [
        'selling_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Check if product is in stock
    public function inStock()
    {
        return $this->quantity > 0;
    }

    // Get profit margin
    public function profitMargin()
    {
        if ($this->cost_price == 0) return 0;
        return (($this->selling_price - $this->cost_price) / $this->cost_price) * 100;
    }

    // Deduct from inventory
    public function deductQuantity($qty)
    {
        $this->quantity -= $qty;
        $this->save();
    }
}