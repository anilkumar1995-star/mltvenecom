<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductLicenseCode extends Model
{
    protected $table = 'ec_product_license_codes';

    protected $fillable = [
        'product_id',
        'license_code',
        'status',
        'assigned_order_product_id',
        'assigned_at',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function assignedOrderProduct(): BelongsTo
    {
        return $this->belongsTo(OrderProduct::class, 'assigned_order_product_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

    public function isUsed(): bool
    {
        return $this->status === 'used';
    }

    public function markAsUsed($orderProductId): void
    {
        $this->update([
            'status' => 'used',
            'assigned_order_product_id' => $orderProductId,
            'assigned_at' => now(),
        ]);
    }

    public function markAsAvailable(): void
    {
        $this->update([
            'status' => 'available',
            'assigned_order_product_id' => null,
            'assigned_at' => null,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('status', 'available');
    }

    public function scopeUsed(Builder $query): Builder
    {
        return $query->where('status', 'used');
    }

    public function scopeForProduct(Builder $query, int $productId): Builder
    {
        return $query->where('product_id', $productId);
    }
}
