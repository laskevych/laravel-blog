<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\BlogPost;

class BlogPostPosted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $blogPost;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(BlogPost $blogPost)
    {
        $this->blogPost = $blogPost;
    }
}
