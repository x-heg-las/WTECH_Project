<!DOCTYPE html>
<html lang="en">
<head>
        @include('layout.partials.head')
        @yield('title')
        @livewireStyles
</head>

<body>
    @include('layout.partials.nav')

    <main class="container-xxl px-4 px-xl-4 px-xxl-0">

        @yield('content')

    </main>
    @livewireScripts
    @include('layout.partials.footer')
</body>
</html>