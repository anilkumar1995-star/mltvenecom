<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    protected $table = 'apis';

    protected $fillable = [
        'product',
        'name',
        'url',
        'username',
        'password',
        'optional1',
        'optional2',
        'optional3',
        'code',
        'type',
        'status',
        'tds',
        'commissiontype',
        'commissionCharge',
    ];
}
