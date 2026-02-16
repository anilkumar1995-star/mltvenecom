<?php

namespace Botble\Contact\Models;

use Botble\Base\Casts\SafeContent;
use Illuminate\Database\Eloquent\Model;

class ContactReply extends BaseModel
{
    protected $table = 'contact_replies';

    protected $fillable = [
        'message',
        'contact_id',
    ];

    protected $casts = [
        'message' => SafeContent::class,
    ];
}
