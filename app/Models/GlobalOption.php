<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GlobalOption extends Model
{
    protected $table = 'ec_global_options';

    protected $fillable = [
        'name',
        'option_type',
        'required',
    ];

    protected static function booted()
    {
        static::deleting(function ($option) {
            $option->values()->delete();
        });
    }

    public function values(): HasMany
    {
        return $this->hasMany(GlobalOptionValue::class , 'option_id')->orderBy('order');
    }
}
