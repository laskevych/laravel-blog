@extends('layout')

@section('content')
<div class="row">

    <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <h1 class="card-title">
                    {{ $post->title }}
                    
                    @badge(['show' => now()->diffInMinutes($post->created_at) < 30])
                        New!
                    @endbadge
                </h1>

                @if ($post->image)
                    <img class="card-img mb-3" src="{{ $post->image->url() }}" alt="{{ $post->title }}">
                @endif
                


                <p class="card-text">{!! $post->content !!}</p>

                <div class="d-flex justify-content-around">
                    <p class="card-text">
                        @updated(['date' => $post->created_at->diffForHumans(),'name' => $post->user->name, 'userId'=>$post->user->id])
                        @endupdated    
                    </p>
                        
                    <p class="card-text">
                        @updated(['date' => $post->updated_at->diffForHumans(),'name' => $post->user->name, 'userId'=>$post->user->id])
                        Updated
                        @endupdated
                    </p>

                    <p class="card-text text-muted">
                        <small>{{ __('posts.current_reading_title') }}</small> <small class="font-weight-bold">{{ trans_choice('posts.current_reading_plural',  $counter) }}</small>
                    </p>
                </div>
                
                <div class="d-flex justify-content-start">
                    <div class="card-text">
                        @tags(['tags'=>$post->tags])
                        @endtags
                    </div>
                    
                </div>
            </div>

            @auth
                @canany(['update', 'delete','restore'], $post)
                    <div class="card-footer d-flex justify-content-around">
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
                    </div>
                @endcanany
            @endauth
        </div>

        <ul class="list-group list-group-flush border-0 mt-4">
            <li class="list-group-item border-0 rounded mb-2 shadow-sm">
                @commentForm(['route' => route('posts.comments.store', ['post' => $post->id])])
                @endcommentForm
            </li>
            @forelse ($post->comments as $comment)
                <li class="list-group-item border-0 rounded mb-2 shadow-sm">
                    {!! $comment->content !!}
                    <div class="d-flex justify-content-between">
                        <p class="mb-0">
                            @updated(['date' => $comment->created_at->diffForHumans(), 'name'=>$comment->user->name, 'userId'=>$comment->user->id])
                            @endupdated
                        </p>
                        <div class="mb-0">
                            @auth
                                @if (!$comment->trashed())
                                    @can('delete', $comment)
                                        <button type="button" class="close" aria-label="{{ __('Delete') }}" onclick="event.preventDefault();document.getElementById('fn-delete-comment-form_{{ $comment->id }}').submit()">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <form style="display:none" id="fn-delete-comment-form_{{ $comment->id }}" method="POST" action="{{ route('posts.comments.destroy', ['post'=>$post->id, 'comment'=>$comment->id])}}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="delete"/>
                                        </form>
                                    @endcan
                                @endif
                            @endauth
                        </div>
                    </div>
                </li>
            @empty
                <li class="list-group-item border-0 rounded mb-2 shadow-sm">{{ __('Not comments yet') }}</li>
            @endforelse
        </ul> 
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4">
        @include('posts._activity')
    </div>
</div>
@endsection