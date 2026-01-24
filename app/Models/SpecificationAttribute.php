<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecificationAttribute extends Model
{
    protected $table = 'ec_specification_attributes';

    protected $fillable = [
        'name',
        'group_id',
        'field_type',
        'description',
    ];

    public function group()
    {
        return $this->belongsTo(SpecificationGroup::class, 'group_id');
    }
}
