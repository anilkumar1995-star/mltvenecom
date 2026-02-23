<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{

    protected $table = 'mp_customer_withdrawals';

    protected $fillable = [
        'customer_id',
        'fee',
        'amount',
        'currency',
        'description',
        'payment_channel',
        'user_id',
        'status',
        'bank_info',
    ];

    protected $casts = [
        'bank_info' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
