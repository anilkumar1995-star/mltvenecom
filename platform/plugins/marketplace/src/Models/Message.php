<?php

namespace Botble\Marketplace\Models;

use Illuminate\Database\Eloquent\Model;
use Botble\Ecommerce\Models\Customer;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends BaseModel
{
    protected $table = 'mp_messages';

    protected $fillable = [
        'store_id',
        'customer_id',
        'name',
        'email',
        'content',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
