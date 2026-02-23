<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date',
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

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'activated');
    }

    public function getIsVendorAttribute(): bool
    {
        return \App\Models\User::where('email', $this->email)->where('role', 'vendor')->exists();
    }
}
