<div class="container">
    @if ($mostCommented)
        <div class="row mb-4 shadow-sm">
            @infocard
                @slot('title')
                    {{ __('Most Commented') }}
                @endslot
                @slot('subtitle')
                    {{ __('What people are currently talking about') }}
                @endslot
                @slot('items')
                    @foreach ($mostCommented as $post)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a class="card-link text-dark" href="{{ route('posts.show', ['id'=> $post->id]) }}">
                                {{ $post->title }}
                            </a>
                            <span class="badge badge-success badge-pill">{{ $post->comments_count }}</span>
                        </li>
                    @endforeach
                @endslot
            @endinfocard
        </div>
    @endif

    @if ($mostActiveUsers)
        <div class="row mb-4 shadow-sm">
            @infocard
                @slot('title')
                    {{ __('Most Active') }}
                @endslot
                @slot('subtitle')
                    {{ __('Writers with most posts written') }}
                @endslot
                @slot('items')
                    @foreach ($mostActiveUsers as $user)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-row align-items-center">
                                <img class="rounded-circle float-left mr-2" width="35px" height="35px" src="{{ $user->image ? $user->image->url() : asset('images/no-image-user.png') }}" alt="">
                                <a class="card-link text-dark" href="{{ route('users.show', ['user'=> $user->id]) }}">
                                    {{ $user->name }}
                                </a>
                            </div>
                            
                            <span class="badge badge-success badge-pill">{{ $user->blog_posts_count }}</span>
                        </li>
                    @endforeach
                @endslot
            @endinfocard
        </div>
    @endif

    @if ($mostActiveUsersLastMonth)
        <div class="row mb-4 shadow-sm">
            @infocard
                @slot('title')
                    {{ __('Most Active Last Month') }}
                @endslot
                @slot('subtitle')
                    {{ __('Users with most posts written in the month') }}
                @endslot
                @slot('items')
                    @foreach ($mostActiveUsersLastMonth as $user)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-row align-items-center">
                                <img class="rounded-circle float-left mr-2" width="35px" height="35px" src="{{ $user->image ? $user->image->url() : asset('images/no-image-user.png') }}" alt="">
                                <a class="card-link text-dark" href="{{ route('users.show', ['user'=> $user->id]) }}">
                                    {{ $user->name }}
                                </a>
                            </div>
                            <span class="badge badge-success badge-pill">{{ $user->blog_posts_count }}</span>
                        </li>
                    @endforeach
                @endslot
            @endinfocard
        </div>
    @endif
</div>