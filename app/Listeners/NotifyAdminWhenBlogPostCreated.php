<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\BlogPostPosted;
use App\User;
use App\Jobs\ThrottledMail;
use App\Mail\BlogPostAdded;

class NotifyAdminWhenBlogPostCreated
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(BlogPostPosted $event)
    {
        User::thatIsAdmin()->get()
            ->map(function (User $user) use ($event){
                ThrottledMail::dispatch(
                    new BlogPostAdded($event->blogPost),
                    $user
                );
            });
    }
}
