<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $table = 'ec_brands';

    protected $fillable = [
        'name',
        'description',
        'website',
        'logo',
        'status',
        'order',
        'is_featured',
        'slug',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'order' => 'integer',
    ];

    // Relationships
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'brand_id');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
