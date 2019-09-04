<nav class="shadow-sm navbar sticky-top navbar-expand-lg navbar-light" style="background-color: #d9f5ff;">
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ asset('images/site-logo.png') }}" width="30" height="30" class="d-inline-block align-top" alt="{{ env('APP_NAME') }}" title="{{ env('APP_NAME') }}">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
        <ul class="navbar-nav d-flex align-items-center">
            <li class="nav-item {{ Route::currentRouteName() == 'about' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('about') }}">{{ __('About') }}</a>
            </li>
            <li class="nav-item {{ Route::currentRouteName() == 'docs' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('docs') }}">API</a>
            </li>
            <li class="nav-item {{ Route::currentRouteName() == 'posts.index' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('posts.index') }}">{{ __("Blog Posts") }}</a>
            </li>
            <li class="nav-item {{ Route::currentRouteName() == 'users.index' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('users.index') }}">{{ __('Users') }}</a>
            </li>

            @auth
                <li class="nav-item {{ Route::currentRouteName() == 'users.index' ? 'active' : '' }}">
                    <a class="btn btn-sm btn-outline-success" href="{{ route('posts.create') }}">{{ __('Add Blog Post') }}</a>
                </li>
            @endauth
        </ul>

        <ul class="navbar-nav d-flex align-items-center">
            @guest
                <li class="nav-item {{ Route::currentRouteName() == 'login' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="nav-item {{ Route::currentRouteName() == 'register' ? 'active' : '' }}">
                    <a class="btn btn-sm btn-outline-success" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @else
                <li class="nav-item {{ Route::currentRouteName() == 'users.show' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('users.show', ['user' => Auth::user()->id ]) }}">{{ Auth::user()->name }}</a>
                </li>
                <li class="nav-item">
                    <a onclick="event.preventDefault();document.getElementById('logout-form').submit()" class="nav-link" href="{{ route('login') }}">{{ __('Logout') }}</a>
                    <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endguest
        </ul>
    </div>
</nav>