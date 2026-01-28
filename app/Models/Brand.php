<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'cat_id',
        'sub_cat_id',
        'name',
        'description',
        'status',
        'brand_image'
    ];
}
