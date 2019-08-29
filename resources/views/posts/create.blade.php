@extends('layout')

@section('content')

<h1>{{ __('Add Blog Post') }}</h1>
<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    @include('posts._form')
    
    <button class="btn btn-success btn-block" type="submit">{{ __('Create') }}</button>    
</form>


@endsection