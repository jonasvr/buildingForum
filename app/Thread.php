<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    use CommentableTrait, RecordsFeed;
    protected $fillable = ['subject', 'thread', 'user_id'];

    public function feeds()
    {
        return $this->morphMany(Feed::class, 'feedable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_thread');
    }

    public function scopeFilter($filterQuery, ThreadFilters $threadFilters)
    {
        $threadFilters->apply($filterQuery);
    }
}
