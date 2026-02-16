<?php

namespace Botble\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Wishlist extends BaseModel
{
    protected $table = 'ec_wish_lists';

    protected $fillable = [
        'customer_id',
        'product_id',
    ];

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id')->withDefault();
    }
}
