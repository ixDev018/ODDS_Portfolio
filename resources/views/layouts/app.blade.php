<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ODDS — We build what your business needs FAST. Custom software, web, mobile, backend and game development for businesses that can't afford to wait.">
    <title>{{ $title ?? 'ODDS — We Build What Your Business Needs' }}</title>

    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

</body>
</html>
