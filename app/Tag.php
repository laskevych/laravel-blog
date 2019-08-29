<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function blogPosts()
    {
        return $this->morphedByMany('App\BlogPost', 'taggable')->withTimestamps()->as('tagged');
    }

    public function comments()
    {
        return $this->morphedByMany('App\Comment', 'taggable')->withTimestamps()->as('tagged');
    }

    public function scopeMostPopularBlogPostTags()
    {
        return $this->withCount('blogPosts')->orderBy('blog_posts_count', 'desc');
    }
}
