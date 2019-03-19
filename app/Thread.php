<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = ['subject', 'type', 'thread', 'user_id'];

    public function user()
    {
        return $this->belangsTo(User::class);
    }

    public function comment()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
