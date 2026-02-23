<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaxRule extends Model
{
    protected $table = 'ec_tax_rules';

    protected $fillable = [
        'tax_id',
        'country',
        'state',
        'city',
        'zip_code',
        'percentage',
        'priority',
        'is_enabled',
    ];

    /**
     * Parent tax
     */
    public function tax(): BelongsTo
    {
        return $this->belongsTo(Tax::class, 'tax_id');
    }
}
