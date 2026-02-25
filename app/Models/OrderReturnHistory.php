<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderReturnHistory extends Model
{
    protected $table = 'ec_order_return_histories';

    protected $fillable = [
        'user_id',
        'order_return_id',
        'action',
        'description',
        'reason',
    ];

    protected $casts = [
        'action' => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderReturn(): BelongsTo
    {
        return $this->belongsTo(OrderReturn::class, 'order_return_id');
    }
}

