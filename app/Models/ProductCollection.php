<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductCollection extends Model
{
    protected $table = 'ec_product_collections';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status',
        'is_featured',
    ];

    /**
     * Products in this collection
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'ec_product_collection_products',
            'product_collection_id',
            'product_id'
        );
    }

    /**
     * Discounts linked with this collection
     */
    public function discounts(): BelongsToMany
    {
        return $this->belongsToMany(
            Discount::class,
            'ec_discount_product_collections',
            'product_collection_id',
            'discount_id'
        );
    }

    /**
     * Promotions (same relation, no conditions)
     */
    public function promotions(): BelongsToMany
    {
        return $this->belongsToMany(
            Discount::class,
            'ec_discount_product_collections',
            'product_collection_id',
            'discount_id'
        );
    }
}
