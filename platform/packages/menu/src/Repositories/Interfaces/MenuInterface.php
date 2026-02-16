<?php

namespace Botble\Menu\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface MenuInterface extends RepositoryInterface
{
    public function findBySlug(string $slug, bool $active, array $select = [], array $with = []): ?BaseModel;

    public function createSlug(string $name): string;
}
