<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcSpecificationGroup extends Model
{
    protected $table = 'ec_specification_groups';
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

    public function attributes()
{
    return $this->hasMany(EcSpecificationAttribute::class, 'group_id');
}

}
