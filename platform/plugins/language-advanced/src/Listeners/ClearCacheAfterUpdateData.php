<?php

namespace Botble\LanguageAdvanced\Listeners;

use Botble\Base\Events\UpdatedContentEvent;
use Illuminate\Database\Eloquent\Model;
use Botble\Support\Services\Cache\Cache;

class ClearCacheAfterUpdateData
{
    public function handle(UpdatedContentEvent $event): void
    {
        if (! $event->data instanceof BaseModel) {
            return;
        }

        Cache::make($event->data::class)->flush();
    }
}
