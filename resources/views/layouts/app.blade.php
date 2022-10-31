
<x-partials.htmlhead />
<body>
    <x-navbar-component />
    <div id="app">

        <main class="py-4">
            @yield('content')
        </main>
        <footer>
            @yield('footer')
        </footer>
    </div>
    <script src="https://unpkg.com/flowbite@1.4.5/dist/flowbite.js"></script>
</body>
</html>
