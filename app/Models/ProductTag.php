<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductTag extends Model
{
    protected $table = 'ec_product_tags';

    protected $fillable = [
        'name',
        'description',
        'status',
        'slug',
    ];

    // Relationships
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            EcProduct::class,
            'ec_product_tag_product',
            'tag_id',
            'product_id'
        );
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
