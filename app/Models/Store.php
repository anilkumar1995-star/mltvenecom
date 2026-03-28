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
        'verification_note',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

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

    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return str_starts_with($this->logo, 'http') ? $this->logo : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($this->logo, '/');
        }
        return asset('img/noimg.png');
    }

    public function getLogoSquareUrlAttribute()
    {
        if ($this->logo_square) {
            return str_starts_with($this->logo_square, 'http') ? $this->logo_square : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($this->logo_square, '/');
        }
        return asset('img/noimg.png');
    }

    public function getCoverImageUrlAttribute()
    {
        if ($this->cover_image) {
            return str_starts_with($this->cover_image, 'http') ? $this->cover_image : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($this->cover_image, '/');
        }
        return asset('img/noimg.png');
    }
}
