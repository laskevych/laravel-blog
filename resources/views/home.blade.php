@extends('layout')

@section('content')

    <div class="col-12">
        <div class="jumbotron shadow-sm" style="background-color: #d9f5ff;">
            <h1 class="display-4">{{ __('Welcome to') }} {{ env('APP_LONG_NAME') }}!</h1>
            <p class="lead">{{ __('Welcome text') }}</p>
        </div>
        @include('posts._activity')
    </div>
          
@endsection