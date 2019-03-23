<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Thread;
use App\User;

class UserProfileController extends Controller
{
    public function index(User $user)
    {
        $threads = Thread::where('user_id', $user->id)->latest()->paginate(10);
        $comments = Comment::where('user_id', $user->id)->where('commentable_type', 'App\Thread')->latest()->paginate(10);

        $feeds = $user->feeds;

        return view('profile.index', compact('threads', 'comments', 'user', 'feeds'));
    }
}
