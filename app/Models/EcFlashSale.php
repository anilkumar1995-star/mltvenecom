<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcFlashSale extends Model
{
    protected $table = 'ec_flash_sales';

    protected $fillable = [
        'name',
        'end_date',
        'status',
    ];

    protected $casts = [
        'end_date' => 'datetime',
    ];

    public function products()
    {
        return $this->belongsToMany(EcProduct::class, 'ec_flash_sale_products', 'flash_sale_id', 'product_id')
                    ->withPivot(['price', 'quantity', 'sold']);
    }
}
