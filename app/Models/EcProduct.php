<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcProduct extends Model
{
    protected $table = 'ec_products';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'content',
        'status',
        'images',
        'video_media',
        'sku',
        'order',
        'quantity',
        'allow_checkout_when_out_of_stock',
        'with_storehouse_management',
        'stock_status',
        'is_featured',
        'is_new_until',
        'brand_id',
        'is_variation',
        'variations_count',
        'reviews_count',
        'reviews_avg',
        'sale_type',
        'price',
        'sale_price',
        'start_date',
        'end_date',
        'length',
        'wide',
        'height',
        'weight',
        'tax_id',
        'views',
        'store_id',
        'created_by_id',
        'created_by_type',
        'approved_by',
        'image',
        'product_type',
        'barcode',
        'cost_per_item',
        'price_includes_tax',
        'generate_license_code',
        'license_code_type',
        'minimum_order_quantity',
        'maximum_order_quantity',
        'notify_attachment_updated',
        'specification_table_id',
    ];

    protected $casts = [
        'images' => 'array',
        'is_featured' => 'boolean',
        'price_includes_tax' => 'boolean',
        'with_storehouse_management' => 'boolean',
        'allow_checkout_when_out_of_stock' => 'boolean',
    ];

    // Removed image() hasMany relationship to avoid conflict with 'image' field

    public function brand()
    {
        return $this->belongsTo(EcBrand::class, 'brand_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
