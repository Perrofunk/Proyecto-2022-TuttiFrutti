@extends('adminlte::master')
<x-partials.htmlhead />
<body>
    <div id="app">
        
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container">
            <a href="/" class=" text-decoration-none d-flex flex-row align-items-center"><img class="ms-4" src="/img/logo2.png" height="30px" width="30px" alt=""><span>TUTTI FRUTTI</span></a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form class="input-group ms-4 flex-row align-items-center" action="/">    
                        <div class="form-control-info">
                            <input class="text"  type="search" id="form1" class="" placeholder="Search" aria-label="Search" />
                            <label class="form-label" for="form1"></label>
                        </div>
                        <div>
                            <button class="btn btn-outline-light" type="submit">Search</button>
                        </div>
                    </form>
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <footer>
            @yield('footer')
        </footer>
    </div>
</body>
</html>
