<?php

namespace App\Http\Controllers\Api\V1;

use App\BlogPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePost;
use App\Http\Resources\PostResource;
use App\Events\BlogPostPosted;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only(['store', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BlogPost $post, Request $request)
    {
        $perPage = $request->input('per_page') ?? 15;
        return PostResource::collection($post->with(['user'])->paginate($perPage)
            ->appends(
                ['per_page' => $perPage]
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $validateData = $request->validated();
        $validateData['user_id'] = $request->user()->id;
        $post = BlogPost::create($validateData);

        event(new BlogPostPosted($post));

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BlogPost  $post
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $post)
    {
        return new PostResource($post->with(['user', 'tags'])->findOrFail($post->id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BlogPost  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, BlogPost $post)
    {
        $this->authorize($post);
        $validateData = $request->validated();

        $post->fill($validateData);
        $post->save();

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BlogPost  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $post)
    {
        $this->authorize($post);
        $post->delete();

        return response()->json([
            'message' => 'Success.'
        ]);
    }
}
