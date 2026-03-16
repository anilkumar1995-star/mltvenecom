<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'name',
        'content',
        'start_date',
        'end_date',
        'is_active',
        'has_action',
        'action_label',
        'action_url',
        'action_open_new_tab',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
    ];
}
