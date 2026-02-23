<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\EcProduct;

class Tax extends Model
{
    use HasFactory;

    protected $table = 'ec_taxes';

    protected $fillable = [
        'title',
        'percentage',
        'priority',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'percentage' => 'float',
        'priority' => 'integer',
        'status' => 'string',
    ];

    protected static function booted(): void
    {
        static::deleted(function (Tax $tax): void {
            // Detach products when tax is deleted
            if (method_exists($tax->products(), 'detach')) {
                $tax->products()->detach();
            }
        });
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(EcProduct::class, 'ec_tax_products', 'tax_id', 'product_id');
    }

    /**
     * Get the title with percentage.
     *
     * @return string
     */
    public function getTitleWithPercentageAttribute(): string
    {
        return $this->title . ' (' . $this->percentage . '%)';
    }
}
