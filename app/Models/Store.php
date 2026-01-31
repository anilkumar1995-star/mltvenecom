<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'mp_stores';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'country',
        'state',
        'city',
        'customer_id',
        'logo',
        'logo_square',
        'cover_image',
        'description',
        'content',
        'status',
        'company',
        'tax_id',
        'zip_code',
    ];
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'store_id');
    }
}
