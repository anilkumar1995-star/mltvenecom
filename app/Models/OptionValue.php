<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OptionValue extends Model
{
    protected $table = 'ec_option_value';

    protected $fillable = [
        'option_id',
        'option_value',
        'affect_price',
        'affect_type',
        'order',
    ];

    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class, 'option_id');
    }

    // OPTIONAL: simple price calculation
    public function getPriceAttribute()
    {
        if (!$this->option || !$this->option->product) {
            return 0;
        }

        $productPrice = $this->option->product->price ?? 0;

        // affect_type: 0 = fixed, 1 = percentage
        return $this->affect_type == 0
            ? (float) $this->affect_price
            : ($productPrice * $this->affect_price) / 100;
    }
}
