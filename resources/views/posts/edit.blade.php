@extends('layout')

@section('content')

<h1>{{ __('Update Blog Post') }}</h1>
<form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    @include('posts._form')
    
    <button  class="btn btn-success btn-block" type="submit">{{ __('Update') }}</button>    
</form>


@endsection