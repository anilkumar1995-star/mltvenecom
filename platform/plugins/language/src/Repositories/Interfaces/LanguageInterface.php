<?php

namespace Botble\Language\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Botble\Language\Models\Language;
use Botble\Support\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface LanguageInterface extends RepositoryInterface
{
    public function getActiveLanguage(array $select = ['*']): Collection;

    public function getDefaultLanguage(array $select = ['*']): BaseModel|Model|Language|null;
}
