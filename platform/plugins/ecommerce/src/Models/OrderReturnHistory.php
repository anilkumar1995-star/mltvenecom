<?php

namespace Botble\Ecommerce\Models;

use Botble\ACL\Models\User;
use Illuminate\Database\Eloquent\Model;
use Botble\Ecommerce\Enums\OrderReturnHistoryActionEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderReturnHistory extends BaseModel
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
        'action' => OrderReturnHistoryActionEnum::class,
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
