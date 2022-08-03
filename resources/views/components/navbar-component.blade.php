@props(['action'])
<div class="bg-light d-flex flex-column align-top justify-content-center navbar-light">

    <div class="d-flex shadow-sm">
        @if (Auth::check())
            <a href="/home" class=" text-decoration-none d-flex flex-row align-items-center"><img class="ms-4" src="/img/metallica.png" height="30px" width="30px" alt=""><span>Home</span></a>
        @else
            <a href="/" class=" text-decoration-none d-flex flex-row align-items-center"><img class="ms-4" src="/img/metallica.png" height="30px" width="30px" alt=""></a>
        @endif
        
        <x-partials.search :action="$action"/>
        <ul class="navbar-nav ms-auto pe-5 d-flex flex-row gap-4">


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
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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