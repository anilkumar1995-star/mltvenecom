<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    protected $table = 'mp_stores';

    protected $fillable = [
        'name',
        'description',
    ];
}
