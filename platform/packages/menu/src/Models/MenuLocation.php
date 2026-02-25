<?php

namespace Botble\Menu\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuLocation extends BaseModel
{
    protected $table = 'menu_locations';

    protected $fillable = [
        'menu_id',
        'location',
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'menu_id')->withDefault();
    }
}
