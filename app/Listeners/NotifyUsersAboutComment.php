<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\CommentPosted;
use App\Mail\CommentPostedMarkdown;
use App\Jobs\NotifyUsersPostWasCommented;
use App\Jobs\ThrottledMail;

class NotifyUsersAboutComment
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CommentPosted $event)
    {
        ThrottledMail::dispatch(
            new CommentPostedMarkdown($event->comment), 
            $event->comment->commentable->user
        )->onQueue('high');

        NotifyUsersPostWasCommented::dispatch($event->comment)
            ->onQueue('low');
    }
}
