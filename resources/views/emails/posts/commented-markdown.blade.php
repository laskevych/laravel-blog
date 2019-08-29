@component('mail::message')
# New comment ;)

Hi, {{ $comment->commentable->user->name }}. 
Someone has commented on your post '{{ $comment->commentable->title }}'

@component('mail::button', ['color'=>'dark', 'url' => route('posts.show', ['post' => $comment->commentable->id])])
View The Blog Post
@endcomponent

@component('mail::panel')
    {{ $comment->content }}
@endcomponent

@component('mail::button', ['color'=>'dark', 'url' => route('users.show', ['user' => $comment->user->id])])
Visit {{ $comment->user->name }} profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
