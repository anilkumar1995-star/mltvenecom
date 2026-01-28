<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;
    protected $fillable = [
       'cat_id',
       'name',
       'description',
       'status',
       'subcate_image',
    ];
}
