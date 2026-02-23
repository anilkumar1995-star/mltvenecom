<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Wishlist extends Model
{
    protected $table = 'ec_wish_lists';

    protected $fillable = [
        'customer_id',
        'product_id',
    ];

    public function product(): HasOne
    {
        return $this->hasOne(EcProduct::class, 'id', 'product_id')->withDefault();
    }
}

