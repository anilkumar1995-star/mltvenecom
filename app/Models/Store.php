<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'mp_stores';

    protected $fillable = [
        'name',
        'slug',
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
        'zip_code',
        'tax_id',
        'social_links',
        'seo_title',
        'seo_description',
        'seo_index',
        'is_verified',
        'verified_at',
        'verified_by',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function products()
    {
        return $this->hasMany(EcProduct::class, 'store_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'store_id');
    }
}
