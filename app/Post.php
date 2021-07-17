<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $fillable = ["title", "body", "slug", "image_path", "published_at"];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            $post->slug = str_slug($post->title);
            $post->created_by = 1;
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
