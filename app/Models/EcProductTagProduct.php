<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcProductTagProduct extends Model
{
    protected $table = 'ec_product_tag_products';
    protected $fillable = ['product_id','tag_id'];
}
