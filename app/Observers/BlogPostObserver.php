<?php

namespace App\Observers;

use App\BlogPost;
use Illuminate\Support\Facades\Cache;
use Mews\Purifier\Facades\Purifier;

class BlogPostObserver
{
    public function creating(BlogPost $blogPost)
    {
        $blogPost->content = Purifier::clean($blogPost->content);
    }

    public function updating(BlogPost $blogPost)
    {
        $blogPost->content = Purifier::clean($blogPost->content);
        Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
    }

    public function deleting(BlogPost $blogPost)
    {
        Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
        $blogPost->comments()->delete();
        $blogPost->image()->delete();
    }

    public function restoring(BlogPost $blogPost)
    {
        $blogPost->comments()->restore();
    }

}
