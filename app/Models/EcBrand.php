<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcBrand extends Model
{
    protected $fillable = [
        'description',
        'website',
        'logo',
        'status',
        'order',
        'is_featured',
    ];

    public function getUpdatedAtAttribute($value)
    {
        return date('d M y - h:i A', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d M y - h:i A', strtotime($value));
    }
}
