<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Option extends Model
{
    protected $table = 'ec_options';

    protected $fillable = [
        'name',
        'option_type',
        'required',
        'product_id',
        'order',
    ];

    protected static function booted()
    {
        static::deleting(function ($option) {
            $option->values()->delete();
        });
    }

    public function values(): HasMany
    {
        return $this->hasMany(OptionValue::class, 'option_id')
                    ->orderBy('order');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
