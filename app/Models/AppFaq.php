<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppFaq extends Model
{
    protected $table = 'faqs';

    protected $fillable = [
        'question',
        'answer',
        'order',
        'status',
    ];
}
