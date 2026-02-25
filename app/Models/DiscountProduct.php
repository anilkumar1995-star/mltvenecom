<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiscountProduct extends Model
{
    protected $table = 'ec_discount_products';

    protected $fillable = [
        'discount_id',
        'product_id',
    ];

    public function products(): BelongsTo
    {
        return $this->belongsTo(EcProduct::class, 'product_id')->withDefault();
    }
}

