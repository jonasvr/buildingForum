<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Support\Facades\Input;

class LikeController extends Controller
{
    public function toggleLike()
    {
        $commentId = Input::get('commentId');
        $comment = Comment::find($commentId);
        if (!$comment->isLiked()) {
            $comment->likeIt();

            return response()->json(['status' => 'success', 'message' => 'liked']);
        } else {
            $comment->unlikeIt();

            return response()->json(['status' => 'success', 'message' => 'unliked']);
        }
    }
}
