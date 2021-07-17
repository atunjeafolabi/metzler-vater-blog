<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'comments_replies';

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
