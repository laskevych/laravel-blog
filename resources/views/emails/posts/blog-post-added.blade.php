@component('mail::message')
# Someone has posted a blog post

Be sure to proof read it.

@component('mail::button', ['url' => route('posts.show', ['post'=>$blogPost->id])])
View The Blog Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
