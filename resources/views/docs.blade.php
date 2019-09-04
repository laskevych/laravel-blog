@extends('layout')

@section('content')
    <div class="col-12">
        
        <p>
            <span class="alert alert-success">You can get your API token in your profile.</span>
        </p>

        <hr>
        <h1>Basic</h1>
        <p class="h4">Status</p>
        <p class="font-weight-bold">Method: <code>GET</code></p>
        <p><kbd>{{ route('api.v1.status') }}</kbd></p>

        <hr>
        <h1>Blog Posts</h1>

        <p class="h4 text-info">Get posts</p>
        <p class="font-weight-bold">Method: <code>GET</code></p>
        <p class="font-weight-bold">Headers: <code>Accept: application/json</code></p>
        <p><kbd>{{ route('api.v1.posts.index') }}</kbd></p>

        <p class="h4 text-info">Get post</p>
        <p class="font-weight-bold">Method: <code>GET</code></p>
        <p class="font-weight-bold">Headers: <code>Accept: application/json</code></p>
        <p><kbd>{{ route('api.v1.posts.show', ['post'=>1]) }}</kbd></p>

        <p class="h4 text-info">Create post</p>
        <p class="font-weight-bold">Method: <code>POST</code></p>
        <p class="font-weight-bold">Headers: <code>Accept: application/json; Content-Type: application/json</code></p>
        <p class="font-weight-bold">Authorization: <code>Bearer: your api token</code></p>
        <p class="font-weight-bold">Body: 
            <code>
            {
                "title": "Hello API!",
                "content": "Content API TEST"
            }
            </code>
        </p>
        <p><kbd>{{ route('api.v1.posts.store') }}</kbd></p>

        <p class="h4 text-info">Update post</p>
        <p class="font-weight-bold">Method: <code>PUT</code></p>
        <p class="font-weight-bold">Headers: <code>Accept: application/json; Content-Type: application/json</code></p>
        <p class="font-weight-bold">Authorization: <code>Bearer: your api token</code></p>
        <p class="font-weight-bold">Body: 
            <code>
            {
                "title": "Update Hello API!",
                "content": "Update Content API TEST"
            }
            </code>
        </p>
        <p><kbd>{{ route('api.v1.posts.update', ['post'=>1]) }}</kbd></p>

        <p class="h4 text-info">Delete post</p>
        <p class="font-weight-bold">Method: <code>DELETE</code></p>
        <p class="font-weight-bold">Headers: <code>Accept: application/json</code></p>
        <p class="font-weight-bold">Authorization: <code>Bearer: your api token</code></p>
        <p><kbd>{{ route('api.v1.posts.destroy', ['post'=>1]) }}</kbd></p>


        <hr>
        <h1>Blog Posts Comments</h1>

        <p class="h4 text-info">Get post comments</p>
        <p class="font-weight-bold">Method: <code>GET</code></p>
        <p class="font-weight-bold">Headers: <code>Accept: application/json</code></p>
        <p><kbd>{{ route('api.v1.posts.comments.index', ['post', 1]) }}</kbd></p>

        <p class="h4 text-info">Get post comment</p>
        <p class="font-weight-bold">Method: <code>GET</code></p>
        <p class="font-weight-bold">Headers: <code>Accept: application/json</code></p>
        <p><kbd>{{ route('api.v1.posts.comments.show', ['post'=>1, 'comment'=>2]) }}</kbd></p>

        <p class="h4 text-info">Create post comment</p>
        <p class="font-weight-bold">Method: <code>POST</code></p>
        <p class="font-weight-bold">Headers: <code>Accept: application/json; Content-Type: application/json</code></p>
        <p class="font-weight-bold">Authorization: <code>Bearer: your api token</code></p>
        <p class="font-weight-bold">Body: 
            <code>
            {
                "title": "Hello Comment API!",
                "content": "Content Comment API"
            }
            </code>
        </p>
        <p><kbd>{{ route('api.v1.posts.comments.store', ['post'=>1]) }}</kbd></p>

        <p class="h4 text-info">Update post comment</p>
        <p class="font-weight-bold">Method: <code>PUT</code></p>
        <p class="font-weight-bold">Headers: <code>Accept: application/json; Content-Type: application/json</code></p>
        <p class="font-weight-bold">Authorization: <code>Bearer: your api token</code></p>
        <p class="font-weight-bold">Body: 
            <code>
            {
                "title": "Update Hello Comment API!",
                "content": "Update Content Comment API"
            }
            </code>
        </p>
        <p><kbd>{{ route('api.v1.posts.comments.update', ['post'=>1, 'comment'=>2]) }}</kbd></p>

        <p class="h4 text-info">Delete post comment</p>
        <p class="font-weight-bold">Method: <code>DELETE</code></p>
        <p class="font-weight-bold">Headers: <code>Accept: application/json</code></p>
        <p class="font-weight-bold">Authorization: <code>Bearer: your api token</code></p>
        <p><kbd>{{ route('api.v1.posts.comments.destroy', ['post'=>1, 'comment'=>3]) }}</kbd></p>
    </div>
@endsection