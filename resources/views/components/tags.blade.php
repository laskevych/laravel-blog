@if (!empty($tags))
    <p>
        @foreach ($tags as $tag)
            <a href="{{ route('posts.tags.index', ['tag'=> $tag->id]) }}" class="badge badge-light badge-sm mb-1">#{{ $tag->name }}</a>
        @endforeach
    </p>
@endif
