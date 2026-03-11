<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'parent_id', 'description', 'status', 'author_id',
        'author_type', 'icon', 'order', 'is_featured', 'is_default'
    ];
}
