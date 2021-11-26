<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
    <title>
        @yield('title')
    </title>
</head>

<body class="g-sidenav-show  bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
        id="sidenav-main">
        @include('layouts.sidenav')
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <!-- Navbar -->
        @include('layouts.navbar')
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @yield('content')
            <footer class="footer pt-3  ">
            </footer>
        </div>
    </main>
    @stack('script')
    @include('layouts.script')
</body>

</html>
