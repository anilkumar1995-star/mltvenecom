<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProductLabel extends Model
{
    protected $table = 'ec_product_labels';

    protected $fillable = [
        'name',
        'color',
        'text_color',
        'status',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'ec_product_label_products',
            'product_label_id',
            'product_id'
        );
    }

    protected function cssStyles(): Attribute
    {
        return Attribute::get(function () {
            $styles = [];

            if (!empty($this->color)) {
                $styles[] = 'background-color:' . $this->color;
            }

            if (!empty($this->text_color)) {
                $styles[] = 'color:' . $this->text_color;
            }

            return implode('; ', $styles);
        });
    }
}
