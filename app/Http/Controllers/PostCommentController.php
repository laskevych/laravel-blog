<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use Illuminate\Http\Request;
use App\BlogPost;
use App\Comment;
use App\Events\CommentPosted as AppCommentPosted;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'edit', 'update', 'destroy']);
    }

    public function store(BlogPost $post, StoreComment $request)
    {
        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

        event(new AppCommentPosted($comment));
        
        $request->session()->flash('status', __("Comment was created"));

        return redirect()->back();
    }

    
    public function destroy(BlogPost $post, Comment $comment, Request $request)
    {
        $this->authorize($comment);
        $comment->delete();

        $request->session()->flash('status', __('Comment was deleted!'));

        return redirect()->route('posts.show', ['post' => $post->id]);
    }
}