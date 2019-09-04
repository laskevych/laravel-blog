<?php

namespace App\Http\Controllers;

use App\User;
use App\Comment;
use App\Http\Requests\StoreComment;
use Illuminate\Http\Request;

class UserCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'destroy']);
    }

    public function store(User $user, StoreComment $request)
    {
        $user->commentsOn()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

        return redirect()->back()
            ->withStatus(__('Comment was created'));
    }

    public function destroy(User $user, Comment $comment, Request $request)
    {
        $comment->delete();

        $request->session()->flash('status', __('Comment was deleted!'));

        return redirect()->route('users.show', ['user' => $user->id]);
    }
}
