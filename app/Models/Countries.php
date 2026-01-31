<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'name',
        'nationality',
        'order',
        'images',
        'is_default',
        'status',
        'code',
       
    ];
}
