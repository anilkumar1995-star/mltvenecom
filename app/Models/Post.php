<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'name', 'description', 'content', 'status', 'author_id',
        'author_type', 'is_featured', 'image', 'views', 'format_type'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
