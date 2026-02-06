<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'ec_products';

    protected $fillable = [
        'name',
        'description',
        'content',
        'image',
        'images',
        'sku',
        'quantity',
        'price',
        'sale_price',
        'brand_id',
        'status',
        'stock_status',
        'is_featured',
        'slug',
        'views',
        'video_media',
        'allow_checkout_when_out_of_stock',
        'with_storehouse_management',
        'is_new_until',
        'sale_type',
        'start_date',
        'end_date',
        'length',
        'wide',
        'height',
        'weight',
        'tax_id',
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
        'price' => 'float',
        'sale_price' => 'float',
        'quantity' => 'integer',
        'is_featured' => 'boolean',
        'views' => 'integer',
    ];

    // ============================================
    // RELATIONSHIPS
    // ============================================

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductCategory::class,
            'ec_product_category_product',
            'product_id',
            'category_id'
        );
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductTag::class,
            'ec_product_tag_product',
            'product_id',
            'tag_id'
        );
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'product_id')
            ->where('status', 'published');
    }

    // ============================================
    // HELPER METHODS
    // ============================================

    public function isOutOfStock(): bool
    {
        return $this->quantity <= 0;
    }

    public function isOnSale(): bool
    {
        return $this->sale_price > 0 && $this->sale_price < $this->price;
    }

    public function getFinalPrice(): float
    {
        if ($this->isOnSale()) {
            return $this->sale_price;
        }
        return $this->price;
    }

    public function getDiscountPercentage(): int
    {
        if (!$this->isOnSale()) {
            return 0;
        }
        
        return (int) round((($this->price - $this->sale_price) / $this->price) * 100);
    }

    public function getImagesArray(): array
    {
        if (empty($this->images)) {
            return [];
        }

        $images = json_decode($this->images, true);
        return is_array($images) ? $images : [];
    }

    // ============================================
    // SCOPES
    // ============================================

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('quantity', '>', 0);
    }

    public function scopeOnSale($query)
    {
        return $query->where('sale_price', '>', 0)
                     ->whereColumn('sale_price', '<', 'price');
    }
}
