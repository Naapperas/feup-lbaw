<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
        crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>
    <script type="text/javascript" src={{ asset('js/app.js') }} defer></script>
</head>

<body>
    <header class="navbar sticky-top bg-light">
        <div class="container-xxl">
            <a class="navbar-brand"
                href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
        </div>
    </header>
    <main class="container-xxl my-md-4">
        @yield('content')
    </main>
    <footer class="bd-footer py-4 bg-light">
        <nav class="d-flex justify-content-center gap-4">
            <a href="{{ url('about') }}">About us</a>
            <a href="{{ url('faq') }}">FAQ</a>
            <a href="{{ url('contacts') }}">Contacts</a>
            <a href="{{ url('services') }}">Services</a>
        </nav>
    </footer>
</body>

</html>
