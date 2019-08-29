@extends('layout')

@section('content')
    <h1>Hello!</h1>
    <p>This is my contact page</p> 

    @can('home.secret')
        <a href="{{ route('secret') }}">Secret Page!</a>
    @endcan
@endsection

