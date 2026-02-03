<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcSpecificationTable extends Model
{
    protected $fillable = [
        'name',
        'description',
        'author_type',
        'author_id'
    ];



    public function getUpdatedAtAttribute($value)
    {
        return date('d M y - h:i A', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d M y - h:i A', strtotime($value));
    }
    
    public function groups()
    {
        return $this->belongsToMany(
            EcSpecificationGroup::class,
            'ec_specification_table_groups',
            'table_id',
            'group_id'
        );
    }

}