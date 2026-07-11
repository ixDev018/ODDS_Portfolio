<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ODDS — We build what your business needs FAST. Custom software, web, mobile, backend and game development for businesses that can't afford to wait.">
    <title>ODDS — We Build What Your Business Needs</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    @include('components.navbar')

    <main>
        {{ $slot }}
    </main>

    @include('components.footer')

</body>
</html>
