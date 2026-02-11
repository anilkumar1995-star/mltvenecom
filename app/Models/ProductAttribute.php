<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = 'ec_product_attributes';

    protected $fillable = [
        'title',
        'slug',
        'color',
        'order',
        'attribute_set_id',
        'image',
        'is_default',
    ];

    protected $casts = [
        'order' => 'integer',
        'is_default' => 'boolean',
    ];

    protected static function booted()
    {
        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });

        static::deleted(function ($attribute) {
            $attribute->productVariationItems()->delete();
        });
    }

    public function productAttributeSet(): BelongsTo
    {
        return $this->belongsTo(ProductAttributeSet::class, 'attribute_set_id');
    }

    public function productVariationItems(): HasMany
    {
        return $this->hasMany(ProductVariationItem::class, 'attribute_id');
    }

    public function getImageUrl(): ?string
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : null;
    }

    public function getStyle(): string
    {
        if ($this->image) {
            $url = $this->getImageUrl();
            return "background-image:url('$url');background-size:cover;background-position:center;";
        }

        return 'background-color:' . ($this->color ?: '#000') . ';';
    }
}
