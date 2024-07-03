<!DOCTYPE html>
<html lang="en">

<head>
    @vite('resources/css/app.css')
    <meta charset="UTF-8">
    <meta name="base-url" content="{{ url('/') }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
</head>

<body>
    @include('header')

    @yield('content')


</body>
<footer>
    @include('footer')
</footer>

</html>