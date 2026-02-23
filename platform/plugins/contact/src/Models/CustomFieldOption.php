<?php

namespace Botble\Contact\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomFieldOption extends BaseModel
{
    protected $table = 'contact_custom_field_options';

    protected $fillable = [
        'custom_field_id',
        'label',
        'value',
        'order',
    ];

    protected $casts = [
        'order' => 'int',
    ];

    public function customField(): BelongsTo
    {
        return $this->belongsTo(CustomField::class, 'custom_field_id');
    }
}
