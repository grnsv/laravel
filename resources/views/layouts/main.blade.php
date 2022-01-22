<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@section('title') - GeekBrains News @show</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body>
    <x-header />

    <main>
        <section class="py-5 text-center container">
            @yield('header')
        </section>

        <div class="album py-5 bg-light">
            @yield('content')
        </div>
    </main>

    <x-footer />

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
