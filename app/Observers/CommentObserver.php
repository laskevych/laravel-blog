<?php

namespace App\Observers;

use App\Comment;
use App\BlogPost;
use Illuminate\Support\Facades\Cache;
use Mews\Purifier\Facades\Purifier;

class CommentObserver
{

    public function creating(Comment $comment) {

        $comment->content = Purifier::clean($comment->content);

        if ($comment->commentable_type == BlogPost::class) {
            Cache::tags(['blog-post'])->forget("blog-post-{$comment->commentable_id}");
        }
    }

    public function updating(Comment $comment) 
    {
        $comment->content = Purifier::clean($comment->content);

        if ($comment->commentable_type == BlogPost::class) {
            Cache::tags(['blog-post'])->forget("blog-post-{$comment->commentable_id}");
        }
    }

    /**
     * Handle the comment "deleted" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function deleted(Comment $comment)
    {
        if ($comment->commentable_type == BlogPost::class) {
            Cache::tags(['blog-post'])->forget("blog-post-{$comment->commentable_id}");
        }
    }

    /**
     * Handle the comment "restored" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function restored(Comment $comment)
    {
        //
    }
}
