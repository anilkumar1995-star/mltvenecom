<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\EcProduct;

class Review extends Model
{
    protected $table = 'ec_reviews';

    protected $fillable = [
        'product_id',
        'customer_id',
        'star',
        'comment',
        'status',
        'images',
    ];

    protected $casts = [
        'star' => 'integer',
        'images' => 'json',
    ];

    // Relationships
    public function product(): BelongsTo
    {
        return $this->belongsTo(EcProduct::class, 'product_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'published');
    }
}
