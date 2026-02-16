<?php

namespace Botble\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiscountProductCollection extends BaseModel
{
    protected $table = 'ec_discount_product_collections';

    protected $fillable = [
        'discount_id',
        'product_collection_id',
    ];

    public function productCollections(): BelongsTo
    {
        return $this->belongsTo(ProductCollection::class, 'product_collection_id')->withDefault();
    }
}
