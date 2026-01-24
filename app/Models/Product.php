<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'ec_products';

    protected $fillable = [
        'name',
        'sku',
        'price',
        'quantity',
        'stock_status',
        'sort_order',
        'status',
        'description',
    ];

    // placeholder relation for images
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
