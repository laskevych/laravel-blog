@extends('layout')

@section('content')

    <div class="col-12">
        <div class="jumbotron shadow-sm text-center" style="background-color: #d9f5ff;">
            <img class="mx-auto d-block" src="{{ asset('images/site-full-logo.png') }}" alt="">
            <p class="lead">{{ __('Welcome text') }}</p>
        </div>
        @include('posts._activity')
    </div>
          
@endsection