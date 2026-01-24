<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecificationTable extends Model
{
    protected $table = 'ec_specification_tables';

    protected $fillable = [
        'name',
        'description',
    ];

    // If you have a pivot relationship to groups, implement it here.
    public function groups()
    {
        // Example pivot: ec_specification_table_group (table_id, group_id)
        return $this->belongsToMany(SpecificationGroup::class, 'ec_specification_table_group', 'table_id', 'group_id');
    }
}
