<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSpecificationAttributeTranslation extends Model
{
    protected $fillable = [
        'product_id',
        'attribute_id',
        'lang_code',
        'value',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(SpecificationAttribute::class, 'attribute_id');
    }

    /**
     * Get translated value
     */
    public static function getValue(
        int $productId,
        int $attributeId,
        string $langCode
    ): ?string {
        return self::where('product_id', $productId)
            ->where('attribute_id', $attributeId)
            ->where('lang_code', $langCode)
            ->value('value');
    }
}
