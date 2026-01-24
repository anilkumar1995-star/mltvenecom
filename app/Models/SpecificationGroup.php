<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecificationGroup extends Model
{
    protected $table = 'ec_specification_groups';

    protected $fillable = [
        'name',
        'description',
    ];
}
