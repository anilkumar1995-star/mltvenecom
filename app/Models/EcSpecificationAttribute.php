<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcSpecificationAttribute extends Model
{
    protected $fillable = [
        'group_id',
        'name',
        'type',
        'options',
        'default_value',
        'author_type',
        'author_id',
    ];

    public function group()
    {
        return $this->belongsTo(EcSpecificationGroup::class, 'group_id');
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d M y - h:i A', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d M y - h:i A', strtotime($value));
    }
}
