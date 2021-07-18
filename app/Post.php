<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $fillable = ["title", "body", "slug", "image_path", "category_id", "published_at"];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            $post->slug = str_slug($post->title);
            $post->created_by = 1;  // TODO: use Auth::id()
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
