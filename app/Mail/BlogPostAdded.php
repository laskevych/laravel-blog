<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\BlogPost;

class BlogPostAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $blogPost;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(BlogPost $blogPost)
    {
        $this->blogPost = $blogPost;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'New Post!';
        return $this
            ->subject($subject)
            ->markdown('emails.posts.blog-post-added');
    }
}
