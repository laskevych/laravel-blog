@extends('layout')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-lg-2 col-sm-4 col-md-4">
            <div class="card border-0 shadow-sm">
                
                <img class="card-img-top" src="{{ $user->image ? $user->image->url() : asset('images/no-image-user.png') }}" alt="{{ $user->name }}">
               
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    @if (Auth::user()->is_admin)
                        <p class="card-text text-muted">{{ $user->email }}</p>
                    @endif

                    @can('update', $user)
                        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-success btn-sm btn-block">{{ __('Edit') }}</a>
                    @endcan

                    <button type="button" class="btn btn-light btn-sm btn-block">
                        {{ __('Browsing Now') }} <span class="badge badge-dark">{{ $counter }}</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-10 col-sm-8 col-md-8">
                <ul class="list-group list-group-flush border-0">
                    <li class="list-group-item border-0 rounded mb-2 shadow-sm">
                        @commentForm(['route' => route('users.comments.store', ['user' => $user->id])])
                        @endcommentForm
                    </li>
                    @forelse ($user->commentsOn as $comment)
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
                                                <form style="display:none" id="fn-delete-comment-form_{{ $comment->id }}" method="POST" action="{{ route('users.comments.destroy', ['user'=>$user->id, 'comment'=>$comment->id])}}">
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
    </div>
@endsection