<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcProductTag extends Model
{
    protected $fillable = ['name','description','status'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($tag) {
            $tag->translations()->delete();
            $tag->products()->detach();
        });
    }

    public function translations()
    {
        return $this->hasMany(EcProductTagTranslation::class,'ec_product_tags_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'ec_product_tag_products','tag_id','product_id');
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d M y - h:i A', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d M y - h:i A', strtotime($value));
    }
}
