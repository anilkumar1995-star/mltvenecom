<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductAttributeSet extends Model
{
    use HasFactory;

    protected $table = 'ec_product_attribute_sets';

    protected $fillable = [
        'title',
        'slug',
        'status',
        'order',
        'display_layout',
        'is_searchable',
        'is_comparable',
        'is_use_in_product_listing',
        'use_image_from_product_variation',
    ];

    protected $casts = [
        'order' => 'integer',
        'is_searchable' => 'boolean',
        'is_comparable' => 'boolean',
        'is_use_in_product_listing' => 'boolean',
        'use_image_from_product_variation' => 'boolean',
    ];

    protected static function booted()
    {
        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = \Str::slug($model->title);
            }
        });

        static::deleted(function ($set) {
            $set->attributes()->delete();
            $set->categories()->detach();
        });
    }


    public function attributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class, 'attribute_set_id')
                    ->orderBy('order', 'asc');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductCategory::class,
            'ec_product_categorizables',
            'reference_id',
            'category_id'
        );
    }

    public static function getByProductId(int|array|string|null $productId): Collection
    {
        $productId = (array) $productId;

        return self::query()
            ->join('ec_product_with_attribute_set',
                'ec_product_attribute_sets.id',
                '=',
                'ec_product_with_attribute_set.attribute_set_id'
            )
            ->whereIn('ec_product_with_attribute_set.product_id', $productId)
            ->with('attributes')
            ->orderBy('ec_product_with_attribute_set.order')
            ->select('ec_product_attribute_sets.*')
            ->get();
    }

    public static function getAllWithSelected(int|array|string|null $productId): Collection
    {
        $productId = (array) $productId;

        return self::query()
            ->leftJoin('ec_product_with_attribute_set', function ($join) use ($productId) {
                $join->on(
                    'ec_product_attribute_sets.id',
                    '=',
                    'ec_product_with_attribute_set.attribute_set_id'
                )->whereIn('ec_product_with_attribute_set.product_id', $productId);
            })
            ->select([
                'ec_product_attribute_sets.*',
                'ec_product_with_attribute_set.product_id as is_selected',
            ])
            ->with('attributes')
            ->orderBy('order', 'asc')
            ->get();
    }
}
