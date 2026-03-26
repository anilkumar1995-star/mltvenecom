<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vendor extends Model
{
    protected $table = 'mp_vendor_info';

    protected $fillable = [
        'customer_id',
        'balance',
        'total_fee',
        'total_revenue',
        'signature',
        'bank_info',
        'payout_payment_method',
        'tax_info',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'total_fee' => 'decimal:2',
        'total_revenue' => 'decimal:2',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function store()
    {
        return $this->hasOneThrough(
            Store::class,
            Customer::class,
            'id',           // Foreign key on ec_customers
            'customer_id',  // Foreign key on mp_stores
            'customer_id',  // Local key on mp_vendor_info
            'id'            // Local key on ec_customers
        );
    }
}
