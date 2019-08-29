<?php

namespace App\Http\Controllers;

use App\Tag;

class PostTagController extends Controller
{
    public function index($tagId)
    {
        $tag = Tag::findOrFail($tagId);

        return view('posts.index', [
            'posts'=> $tag->blogPosts()
                ->latestWithRelation()
                ->paginate(10),
            'tag'=> $tag,
            'meta_title' => __('Tag')." #{$tag->name}"
            ]);
    }
}
