@extends('adminlte::master')
<x-partials.htmlhead />
<body>
    <div id="app" style="background-color: #093a4b">
        <x-navbar-component />

        <main class="py-4">
            @yield('content')
        </main>
        <footer>
            @yield('footer')
        </footer>
    </div>
</body>
</html>
