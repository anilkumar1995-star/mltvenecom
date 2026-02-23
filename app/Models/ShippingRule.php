<?php


namespace App\Models;

use Botble\Ecommerce\Models\ShippingRuleItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShippingRule extends Model
{
    protected $table = 'ec_shipping_rules';

    protected $fillable = [
        'name',
        'price',
        'type',
        'from',
        'to',
        'shipping_id',
    ];

    protected static function booted(): void
    {
        static::deleted(function (ShippingRule $shippingRule): void {
            $shippingRule->items()->delete();
        });
    }

    protected $casts = [
        'type' => 'string',
        'name' => 'string',
    ];

    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Shipping::class)->withDefault();
    }

    public function items(): HasMany
    {
        return $this->hasMany(ShippingRuleItem::class);
    }
}

