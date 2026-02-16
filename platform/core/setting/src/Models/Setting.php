<?php

namespace Botble\Setting\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends BaseModel
{
    protected $table = 'settings';

    protected $fillable = [
        'key',
        'value',
    ];
}
