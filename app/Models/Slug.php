<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Slug extends Model
{
    protected $table = 'slugs';

    protected $fillable = [
        'key',
        'reference_id',
        'reference_type',
        'prefix',
    ];

    /**
     * Get the parent reference model.
     */
    public function reference(): MorphTo
    {
        return $this->morphTo();
    }
}
