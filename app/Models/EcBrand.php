<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class EcBrand extends Model
{
    protected $table = 'ec_brands';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'website',
        'logo',
        'status',
        'order',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];


    public function categories()
    {
        return $this->belongsToMany(
            EcProductCategory::class,
            'ec_brand_categories',
            'brand_id',
            'category_id'
        );
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('status', 'published');
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
