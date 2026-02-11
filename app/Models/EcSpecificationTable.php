<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcSpecificationTable extends Model
{
    protected $table = 'ec_specification_tables';
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
            'ec_specification_table_group',
            'table_id',
            'group_id'
        );
    }

}