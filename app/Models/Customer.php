<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'ec_customers';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'dob',
        'avatar',
        'status',
        'is_vendor',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function store()
    {
        return $this->hasOne(Store::class, 'customer_id');
    }
}
