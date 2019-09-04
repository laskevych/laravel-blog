@extends('layout')

@section('content')
    <div class="col-12">
        <h1>About</h1>
        <p>
            <a target="__blank" href="https://github.com/laskevych/laravel-blog/">GitHub</a>
        </p>
        @can('home.secret')
            <a href="{{ route('secret') }}">Secret Page!</a>
        @endcan
    </div>    
@endsection

