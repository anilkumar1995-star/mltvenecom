<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderAddress extends Model
{
    protected $table = 'ec_order_addresses';

    protected $fillable = [
        'order_id',
        'name',
        'phone',
        'email',
        'country',
        'state',
        'city',
        'address',
        'zip_code',
        'type', // billing or shipping
    ];

    public $timestamps = false;

    // Relationships
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Helper Methods
    public function getFullAddress(): string
    {
        return implode(', ', array_filter([
            $this->address,
            $this->city,
            $this->state,
            $this->zip_code,
            $this->country,
        ]));
    }

    // Scopes
    public function scopeBilling($query)
    {
        return $query->where('type', 'billing');
    }

    public function scopeShipping($query)
    {
        return $query->where('type', 'shipping');
    }
}
