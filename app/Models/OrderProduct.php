<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderProduct extends Model
{
    protected $table = 'ec_order_product';

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_image',
        'qty',
        'price',
        'tax_amount',
        'options',
    ];

    protected $casts = [
        'qty' => 'integer',
        'price' => 'float',
        'tax_amount' => 'float',
        'options' => 'json',
    ];

    public $timestamps = false;

    // Relationships
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Helper Methods
    public function getSubtotal(): float
    {
        return $this->price * $this->qty;
    }

    public function getTotal(): float
    {
        return ($this->price * $this->qty) + $this->tax_amount;
    }
}
