<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcProductTagTranslation extends Model
{
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'lang_code',
        'ec_product_tags_id',
        'name'
    ];

    public function tag()
    {
        return $this->belongsTo(EcProductTag::class,'ec_product_tags_id');
    }
}
