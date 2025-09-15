<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo-apk-simple.png') }}">
</head>
<body>
    <div class="container">
        @yield('content')
    </div>

    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
