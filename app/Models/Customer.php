<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;
    protected $table = 'ec_customers';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'dob',
        'avatar',
        'status',
        'confirmed_at',
        'is_vendor',
        'vendor_verified_at',
        'pan_number',
        'aadhar_number',
        'kyc_kid',
        'kyc_url',
        'kyc_status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date',
        'is_vendor' => 'boolean',
    ];

    // Relationships
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'customer_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'customer_id');
    }

    public function wishlist(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'customer_id');
    }

    public function store(): HasOne
    {
        return $this->hasOne(Store::class, 'customer_id');
    }

    public function vendorInfo(): HasOne
    {
        return $this->hasOne(Vendor::class, 'customer_id');
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(EcProduct::class, Store::class, 'customer_id', 'store_id');
    }

    public function vendorOrders(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(Order::class, Store::class, 'customer_id', 'store_id');
    }

    public function withdrawals(): HasMany
    {
        return $this->hasMany(Withdrawal::class, 'customer_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'activated');
    }

    public function scopeVendors($query)
    {
        return $query->where('is_vendor', 1);
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
             return str_starts_with($this->avatar, 'http') ? $this->avatar : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($this->avatar, '/');
        }
        return asset('home/placeholder.png');
    }
}
