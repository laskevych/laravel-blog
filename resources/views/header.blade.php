<nav class="shadow-sm navbar sticky-top navbar-expand-lg navbar-light" style="background-color: #d9f5ff;">
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ asset('images/site-logo.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
        {{ env('APP_NAME') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
            </li>
            <li class="nav-item {{ Route::currentRouteName() == 'about' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('about') }}">{{ __('About') }}</a>
            </li>
            <li class="nav-item {{ Route::currentRouteName() == 'posts.index' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('posts.index') }}">{{ __("Blog Posts") }}</a>
            </li>
            <li class="nav-item {{ Route::currentRouteName() == 'users.index' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('users.index') }}">{{ __('Users') }}</a>
            </li>
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @guest {{ __('Profile') }} @else {{ Auth::user()->name }} @endguest
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    @guest
                        @if (Route::has('register'))
                            <a class="dropdown-item {{ Route::currentRouteName() == 'register' ? 'active' : '' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                        <a class="dropdown-item {{ Route::currentRouteName() == 'login' ? 'active' : '' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @else
                        <a class="dropdown-item" href="{{ route('posts.create') }}">{{ __('Add Blog Post') }}</a>
                        <a class="dropdown-item" href="{{ route('users.show', ['user' => Auth::user()->id ]) }}">{{ __('View Profile') }}</a>
                        <a onclick="event.preventDefault();document.getElementById('logout-form').submit()" 
                        class="dropdown-item" 
                        href="{{ route('login') }}">{{ __('Logout') }}</a>

                        <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </li>
        </ul>
    </div>
</nav>