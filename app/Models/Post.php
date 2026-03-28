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

    /**
     * Get the post's slug.
     */
    public function slug()
    {
        return $this->morphOne(Slug::class, 'reference');
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            // Delete associated slug
            \Illuminate\Support\Facades\DB::table('slugs')
                ->where('reference_id', $post->id)
                ->where('reference_type', 'Botble\Blog\Models\Post')
                ->delete();

            // Delete associated meta boxes
            \Illuminate\Support\Facades\DB::table('meta_boxes')
                ->where('reference_id', $post->id)
                ->where('reference_type', 'Botble\Blog\Models\Post')
                ->delete();

            // Detach categories and tags
            $post->categories()->detach();
            $post->tags()->detach();
        });
    }
}
