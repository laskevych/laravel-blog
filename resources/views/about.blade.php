@extends('layout')

@section('content')
    <div class="col-12">
        <h1>About</h1>
        @can('home.secret')
            <a href="{{ route('secret') }}">Secret Page!</a>
        @endcan
    </div>    
@endsection

