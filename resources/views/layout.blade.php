<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('images/site-logo.png') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>{{ $meta_title ?? 'Document'}}</title>
</head>
<body>

    @include('header')

    <div class="container mb-5 mt-5">
        @success @endsuccess

        @yield('content')
    </div>
    
    <script src="{{ mix('js/app.js') }}"></script>

    @if (Route::currentRouteName() == 'posts.edit'
        || Route::currentRouteName() == 'posts.create'
        || Route::currentRouteName() == 'posts.show'
        || Route::currentRouteName() == 'users.show')
        @include('tinymce')
    @endif
</body>
</html>