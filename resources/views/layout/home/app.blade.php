<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') &mdash; {{ $appset->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @stack('styles')
</head>

<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ $appset->url }}" class="text-xl font-bold">{{ $appset->name }}</a>
            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}" class="hover:text-blue-200 transition">Login</a>
            </div>
        </div>
    </nav>
    @yield('content')
    @include('layout.home.footer')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    @include('sweetalert::alert')
    @stack('scripts')
</body>

</html>
