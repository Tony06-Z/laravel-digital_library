<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    {{-- TailwindCSS & FlowbiteCSS --}}
    @vite(['resources/css/app.css','resources/js/app.js'])

    {{-- Section for includes file css --}}
    @stack('styles')
</head>
<body>
    
    @yield('content')

    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="{{ asset('js/app.js') }}"></script>
</body>
</html>