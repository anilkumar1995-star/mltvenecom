<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcProductFile extends Model
{
    protected $table = 'ec_product_files';

    protected $fillable = [
        'product_id',
        'url',
        'extras',
    ];

    public function product()
    {
        return $this->belongsTo(EcProduct::class, 'product_id');
    }
}
