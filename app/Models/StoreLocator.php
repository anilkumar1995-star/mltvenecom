<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreLocator extends Model
{
    protected $table = 'ec_store_locators';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'country',
        'state',
        'city',
        'zip_code',
        'is_primary',
        'is_shipping_location',
    ];
}

