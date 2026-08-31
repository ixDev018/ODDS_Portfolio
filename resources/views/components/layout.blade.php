<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ODDS — We build what your business needs FAST. Custom software, web, mobile, backend and game development.">
    <title>ODDS — We Build What Your Business Needs</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/ODDS_logo.svg') }}">
    <link rel="alternate icon" href="{{ asset('assets/img/ODDS_logo.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,300..800;1,300..800&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Rokkitt:wght@700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    @include('components.navbar')
    <div id="smooth-wrapper">
        <div id="smooth-content">
            <main>{{ $slot }}</main>
        </div>
    </div>
    @stack('modals')
    @stack('scripts')
</body>
</html>
