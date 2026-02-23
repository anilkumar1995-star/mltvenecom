<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'currency',
        'user_id',
        'charge_id',
        'payment_channel',
        'description',
        'amount',
        'payment_fee',
        'order_id',
        'status',
        'payment_type',
        'customer_id',
        'refunded_amount',
        'refund_note',
        'customer_type',
        'metadata',
    ];

    protected $casts = [
        'amount' => 'float',
        'payment_fee' => 'float',
        'refunded_amount' => 'float',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
