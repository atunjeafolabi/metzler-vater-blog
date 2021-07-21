<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['title', 'body', 'post_id', 'created_by'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'comment_id', 'id');
    }
}
