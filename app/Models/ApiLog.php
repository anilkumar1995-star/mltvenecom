<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiLog extends Model
{
    protected $table = 'apilogs';

    protected $fillable = [
        'url',
        'modal',
        'txnid',
        'header',
        'request',
        'response',
    ];
}
