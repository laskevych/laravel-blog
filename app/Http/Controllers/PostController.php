<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use App\Events\BlogPostPosted;
use App\Facades\CounterFacade;
use App\BlogPost;
use App\Image;
use App\Tag;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'create', 'store', 'edit', 'destroy', 'restore'
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mostPopularBlogPostTags = Cache::remember('popular-blog-post-tags', now()->addMinutes(30), function () {
            return Tag::mostPopularBlogPostTags()->take(8)->get();
        });

        return view('posts.index', [
            'posts' => BlogPost::latestWithRelation()->paginate(10),
            'meta_title' => __('Blog Posts'), 
            'mostPopularBlogPostTags' => $mostPopularBlogPostTags
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blogPost = Cache::tags(['blog-post'])->remember("blog-post-{$id}", now()->addMinutes(30), function () use ($id) {
            return BlogPost::with(['image','comments', 'user', 'tags', 'comments.user'])->findOrFail($id);
        });

        return view('posts.show', [
            'post' => $blogPost,
            'meta_title' => $blogPost->title,
            'counter' => CounterFacade::increment("blog-post-{$id}", ['blog-post'])
        ]);
    }

    public function create()
    {
        return view('posts.create', ['meta_title' => __('Add Post')]);
    }

    public function store(StorePost $request)
    {
        
        $validateData = $request->validated();
        $validateData['user_id'] = $request->user()->id;
        $blogPost = BlogPost::create($validateData);

    
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');

            $image = new Image();
            $blogPost->image()->save(
                Image::make(['path' => $path])
            );
        }

        event(new BlogPostPosted($blogPost));

        $request->session()->flash('status', 'Blog post was created!');

        return redirect()->route('posts.show', ['post'=>$blogPost->id]);
    }

    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        $this->authorize($post);

        return view ('posts.edit', [
            'post' => $post,
            'meta_title' => __('Update Blog Post')
        ]);
    }

    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        $this->authorize($post);

        $validateData = $request->validated();

        $post->fill($validateData);

        if($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');

            if ($post->image) {
                Storage::delete($post->image->path);
                $post->image->path = $path;
                $post->image->save();
            } else {
                $post->image()->save(
                    Image::make(['path' => $path])
                );
            }
        }

        $post->save();
        $request->session()->flash('status', __('Blog post was updeted'));

        return redirect()->route('posts.show', ['post'=>$post->id]);
    }

    public function destroy(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $this->authorize($post);

        $post->delete();

        $request->session()->flash('status', __('Blog post was deleted!'));

        return redirect()->route('posts.index');
    }

    public function restore(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $this->authorize($post);

        $post->restore();

        $request->session()->flash('status', __('Blog post was restored!'));

        return redirect()->route('posts.index');
    }

}
