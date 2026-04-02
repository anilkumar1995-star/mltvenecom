<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $table = 'ec_orders';

    protected $fillable = [
        'user_id',
        'code',
        'amount',
        'tax_amount',
        'shipping_amount',
        'discount_amount',
        'sub_total',
        'status',
        'shipping_method',
        'shipping_option',
        'payment_id',
        'payment_fee',
        'description',
        'coupon_code',
        'discount_description',
        'is_confirmed',
        'is_finished',
        'token',
        'store_id',
    ];

    protected $casts = [
        'amount' => 'float',
        'tax_amount' => 'float',
        'shipping_amount' => 'float',
        'discount_amount' => 'float',
        'sub_total' => 'float',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function address(): HasMany
    {
        return $this->hasMany(OrderAddress::class, 'order_id');
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function histories(): HasMany
    {
        return $this->hasMany(OrderHistory::class, 'order_id');
    }

    // Helper Methods
    public function getTotalAmount(): float
    {
        return $this->sub_total + $this->tax_amount + $this->shipping_amount - $this->discount_amount;
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isCanceled(): bool
    {
        return $this->status === 'canceled';
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCanceled($query)
    {
        return $query->where('status', 'canceled');
    }
}
