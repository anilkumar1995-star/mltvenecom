<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class EcProductCategory extends Model
{
    protected $table = 'ec_product_categories';

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'description',
        'status',
        'order',
        'image',
        'is_featured',
        'icon',
        'icon_image',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];


    public function parent()
    {
        return $this->belongsTo(self::class , 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class , 'parent_id');
    }

    public function brands()
    {
        return $this->belongsToMany(
            EcBrand::class ,
            'ec_brand_categories',
            'category_id',
            'brand_id'
        );
    }

    public function products()
    {
        return $this->belongsToMany(
            EcProduct::class ,
            'ec_product_category_product',
            'category_id',
            'product_id'
        );
    }


    public function scopePublished(Builder $query)
    {
        return $query->where('status', 'published');
    }

    public function scopeParent(Builder $query)
    {
        return $query->where(function ($q) {
            $q->whereNull('parent_id')
                ->orWhere('parent_id', 0);
        });
    }

    public function scopeFeatured(Builder $query)
    {
        return $query->where('is_featured', 1);
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d M y - h:i A', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d M y - h:i A', strtotime($value));
    }
}
