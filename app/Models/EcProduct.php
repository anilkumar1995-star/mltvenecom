<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Helpers\ImageHelper;

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
        'faq_schema_config',
        'unit_type',
    ];

    protected $casts = [
        'images' => 'array',
        'video_media' => 'array',
        'is_featured' => 'boolean',
        'price_includes_tax' => 'boolean',
        'with_storehouse_management' => 'boolean',
        'allow_checkout_when_out_of_stock' => 'boolean',
        'faq_schema_config' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(EcBrand::class, 'brand_id');
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            EcProductCategory::class,
            'ec_product_category_product',
            'product_id',
            'category_id'
        );
    }

    public function options(): HasMany
    {
        return $this->hasMany(Option::class, 'product_id');
    }

    public function variations(): HasMany
    {
        return $this->hasMany(ProductVariation::class, 'configurable_product_id');
    }

    public function relatedProducts(): BelongsToMany
    {
        return $this->belongsToMany(
            self::class,
            'ec_product_related_relations',
            'from_product_id',
            'to_product_id'
        );
    }

    public function upSellingProducts(): BelongsToMany
    {
        return $this->belongsToMany(
            self::class,
            'ec_product_up_sell_relations',
            'from_product_id',
            'to_product_id'
        );
    }

    public function crossSellingProducts(): BelongsToMany
    {
        return $this->belongsToMany(
            self::class,
            'ec_product_cross_sell_relations',
            'from_product_id',
            'to_product_id'
        );
    }

    public function faqs(): BelongsToMany
    {
        return $this->belongsToMany(
            AppFaq::class,
            'ec_faq_products',
            'product_id',
            'faq_id'
        );
    }

    public function productFaqs(): BelongsToMany
    {
        return $this->faqs();
    }

    public function productCollections(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductCollection::class,
            'ec_product_collection_products',
            'product_id',
            'product_collection_id'
        );
    }

    public function productLabels(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductLabel::class,
            'ec_product_label_products',
            'product_id',
            'product_label_id'
        );
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            EcProductTag::class,
            'ec_product_tag_product',
            'product_id',
            'tag_id'
        );
    }

    public function productAttributeSets(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductAttributeSet::class,
            'ec_product_with_attribute_set',
            'product_id',
            'attribute_set_id'
        );
    }


    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', 1);
    }

    public function scopeOnSale(Builder $query): Builder
    {
        return $query
            ->whereNotNull('sale_price')
            ->where('sale_price', '>', 0);
    }


    public function getIsOnSaleAttribute(): bool
    {
        return !is_null($this->sale_price) && $this->sale_price > 0;
    }

    public function isOnSale(): bool
    {
        return $this->is_on_sale;
    }

    public function getDiscountPercentAttribute(): int
    {
        if (!$this->is_on_sale || $this->price <= 0) {
            return 0;
        }

        return (int) round(
            (($this->price - $this->sale_price) / $this->price) * 100
        );
    }

    public function getFinalPriceAttribute(): float
    {
        return $this->is_on_sale ? (float) $this->sale_price : (float) $this->price;
    }

    public function isOutOfStock(): bool
    {
        if ($this->with_storehouse_management) {
             return $this->quantity <= 0 && !$this->allow_checkout_when_out_of_stock;
        }
        return $this->stock_status === 'out_of_stock';
    }

    public function getDiscountPercentage(): int
    {
        return $this->discount_percent;
    }

    /*
    |--------------------------------------------------------------------------
    | Media Accessors
    |--------------------------------------------------------------------------
    */

    public function getImageUrlAttribute()
    {
        $img = $this->image;
        
        // Fallback to first image from gallery if primary image is empty
        if (empty($img) && !empty($this->images) && is_array($this->images)) {
            $img = $this->images[0] ?? null;
        }

        if (empty($img)) {
            return asset('home/placeholder.png');
        }

        if (str_starts_with($img, 'http')) {
            return $img;
        }

        return rtrim(ImageHelper::getImageUrl(), '/') . '/' . ltrim($img, '/');
    }

    public function getGalleryImageUrlsAttribute()
    {
        $urls = [];
        $images = $this->images ?? [];
        foreach ($images as $img) {
            if (empty($img)) continue;
            
            if (str_starts_with($img, 'http')) {
                $urls[] = $img;
            } else {
                $urls[] = rtrim(ImageHelper::getImageUrl(), '/') . '/' . ltrim($img, '/');
            }
        }
        return $urls;
    }

    public function getVideoUrlAttribute()
    {
        $videoMedia = $this->video_media ?? [];
        $url = $videoMedia[0] ?? null;

        if (empty($url)) {
            return null;
        }

        if (str_starts_with($url, 'http')) {
            return $url;
        }

        return rtrim(ImageHelper::getImageUrl(), '/') . '/' . ltrim($url, '/');
    }
}
