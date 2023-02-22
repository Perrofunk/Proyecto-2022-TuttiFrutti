
<x-partials.htmlhead />
<body class="antialiased ">
    <x-navbar-component />

    <style>
        * {box-sizing: border-box;}
        body {font-family: Verdana, sans-serif;}
        .mySlides {display: none;}
        
        </style>
        <main class="py-4 h-full bg-gray-300">
            @yield('content')
        </main>
        <footer>
            @yield('footer')
        </footer>
    
    <script src="https://unpkg.com/flowbite@1.4.5/dist/flowbite.js"></script>
</body>

