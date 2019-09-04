@extends('layout')

@section('content')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8">

        @if (Route::currentRouteName() == 'posts.tags.index' && isset($tag->name))
            <div class="shadow-sm mb-1 card">
                <h1 class="d-flex justify-content-start mt-1 mb-1 ml-3">#{{ $tag->name }}</h1>
            </div>
        @endif

        @if (isset($mostPopularBlogPostTags))
            <div class="shadow-sm mb-1 card">
                <span class="d-flex flex-wrap justify-content-center">
                        @foreach ($mostPopularBlogPostTags as $tag)
                        <a href="{{ route('posts.tags.index', ['tag'=> $tag->id]) }}" class="badge badge-light mt-1 mb-1 mr-1">#{{ $tag->name }}</a>
                    @endforeach
                </span>
            </div>
        @endif
        
        @forelse ($posts as $post)
        <div class="card shadow-sm mb-4
            @if($post->trashed())
                border-danger border-top-0 border-right-0 border-bottom-0
            @elseif(now()->diffInMinutes($post->created_at) < 30)
                border-success border-top-0 border-right-0 border-bottom-0
            @endif
            ">
            <div class="card-body">
                <h4 class="card-title">
                    <a class="{{ $post->trashed() ? 'text-muted' : 'text-dark'}}" 
                        href="{{ route('posts.show', ['post'=>$post->id]) }}"
                        style="text-decoration: none"
                        >
                        {{ $post->title }}
                    </a>
                </h4>
               
                
                <p class="card-text">
                    <small class="text-muted">
                        {{ trans_choice('posts.comments_plural', $post->comments_count) }}
                    </small>
                </p>
            </div>

            @if (!empty($post->tags->count() != 0))
                <div class="card-body d-flex justify-content-start">
                    @tags(['tags'=>$post->tags])
                    @endtags
                </div>
            @endif
            
            <div class="card-footer d-flex justify-content-around">
                @updated(['date' => $post->created_at->diffForHumans(),'name' => $post->user->name, 'userId'=>$post->user->id])
                @endupdated

                @auth
                    @canany(['update', 'delete','restore'], $post)
                    <div class="d-flex align-self-center">
                        @can('update', $post)
                            <a class="badge badge-light mr-1" href="{{ route('posts.edit', ['post'=>$post->id])}}">{{ __('Edit') }}</a>
                        @endcan

                        @if (!$post->trashed())
                            @can('delete', $post)
                                <a class="badge badge-light" href="{{ route('posts.destroy', ['post'=>$post->id])}}" onclick="event.preventDefault();document.getElementById('fn-delete-form_{{ $post->id }}').submit()">{{ __('Delete') }}</a>
                                <form style="display:none" id="fn-delete-form_{{ $post->id }}" method="POST" action="{{ route('posts.destroy', ['post'=>$post->id])}}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="delete"/>
                                </form>
                            @endcan
                        @else
                            @can('restore', $post)
                                <a class="badge badge-light" href="{{ route('posts.destroy', ['post'=>$post->id])}}" onclick="event.preventDefault();document.getElementById('fn-restore-form_{{ $post->id }}').submit()">{{ __('Restore') }}</a>
                                <form style="display:none" id="fn-restore-form_{{ $post->id }}" method="POST" action="{{ route('posts.restore', ['post'=>$post->id])}}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="submit" value="delete"/>
                                </form>
                            @endcan
                        @endif
                    </div>
                    @endcanany
                @endauth
            </div>
        </div>
        @empty
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    {{ __('No blog posts yet!') }}
                </h5>
            </div>
        </div>
        @endforelse

        
        {{ $posts->links() }}
   
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 d-none d-sm-block">
        @include('posts._activity')
    </div>

</div>

@endsection