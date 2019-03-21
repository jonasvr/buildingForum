<?php
/**
 *
 */
namespace App;

trait LikableTrait
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likable')->latest();
    }

    public function likeIt()
    {
        $like = new like();
        $like->user_id = auth()->user()->id;
        $this->likes()->save($like);

        return $like;
    }

    public function unLikeIt($id)
    {
        $like = Like::find($id);
        $like->delete();

        return true;
    }
}
