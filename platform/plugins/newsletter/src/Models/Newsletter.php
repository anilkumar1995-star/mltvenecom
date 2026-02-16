<?php

namespace Botble\Newsletter\Models;

use Botble\Base\Casts\SafeContent;
use Illuminate\Database\Eloquent\Model;
use Botble\Newsletter\Enums\NewsletterStatusEnum;

class Newsletter extends BaseModel
{
    protected $table = 'newsletters';

    protected $fillable = [
        'email',
        'name',
        'status',
    ];

    protected $casts = [
        'name' => SafeContent::class,
        'status' => NewsletterStatusEnum::class,
    ];
}
