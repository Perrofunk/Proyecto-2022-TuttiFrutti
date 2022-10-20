@props(['action'])
<nav class="nav navbar navbar-dark ">
    <div class="container">
        <a class="navbar-brand d-flex" href="{{ url('/') }}">
            <div class="pe-3" style="border-right:1px solid black" ><img  src="/img/metallica.png" style="height:25px;width:25px;" alt=""></div>
            <div class="ps-3"><strong>TuttiFrutti</strong> </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <div class="btn-group ms-4">
                <a href="products"><button class="btn btn-dark">Productos</button></a>
                <button class="btn btn-dark">Productos</button>
                <button class="btn btn-dark">Productos</button>
            </div>
            
            <form class="input-group ms-4 flex-row align-items-center" action="/">
                <div class="form-outline">
                  <input type="text" name="search" id="form1" class="" />
                  <label class="form-label" for="form1"></label>
                </div>
                <div>
                    <button class="btn btn-outline-light border-0 rounded-0" type="submit">Search</button>
                </div>
            </form>

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

{{-- <div class="bg-dark d-flex flex-column align-top justify-content-center navbar-dark">

    <div class="d-flex shadow-sm">
        @if (Auth::check())
            <a href="/home" class=" text-decoration-none d-flex flex-row align-items-center"><img class="ms-4" src="/img/metallica.png" height="30px" width="30px" alt=""><span>Home</span></a>
        @else
            <a href="/" class=" text-decoration-none d-flex flex-row align-items-center"><img class="ms-4" src="/img/metallica.png" height="30px" width="30px" alt=""></a>
        @endif
        <div class="btn-group ms-4">
            <button class="btn btn-dark">Productos</button>
            <button class="btn btn-dark">Productos</button>
            <button class="btn btn-dark">Productos</button>
        </div>
        
        <form class="input-group ms-4 flex-row align-items-center" action="/">
            <div class="form-outline">
              <input type="text" name="search" id="form1" class="" />
              <label class="form-label" for="form1"></label>
            </div>
            <div>
                <button class="btn btn-outline-light border-0 rounded-0" type="submit">Search</button>
            </div>
        </form>
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
</div> --}}