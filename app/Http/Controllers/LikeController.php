<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class LikeController extends Controller
{
    public function toggleLike()
    {
        $commentId = Input::get('commentId');
        $comment = Comment::find($commentId);

        $usersLike = $comment->likes()
            ->where("user_id", auth()->id())
            ->where('likable_id', $commentId)
            ->first();

        if ($usersLike) {
            $comment->likeIt();
            # code...
        } else {
            $comment->likeIt();

        }

        if ($comment->save()) {
            if (request()->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Liked']);
            }
            return back()->withMessage('Liked');
        }
    }
}
