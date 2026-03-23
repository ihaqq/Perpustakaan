<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Judul Default')</title>
    <link rel="stylesheet" href="{{ asset('asset/css/app.css') }}">
</head>
<body>

    {{-- Navbar --}}
    @include('Admin/partials.navbar')

    {{-- Konten halaman --}}
    <div class="container">
        @yield('content')
    </div>

</body>
</html>
