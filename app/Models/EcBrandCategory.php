<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcBrandCategory extends Model
{
    // protected $table = 'ec_brand_categories';

    protected $fillable = [
        'brand_id',
        'category_id',
    ];

    public function getUpdatedAtAttribute($value)
    {
        return date('d M y - h:i A', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d M y - h:i A', strtotime($value));
    }
}
