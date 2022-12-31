<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title ?? config('app.name') }}</title>
        @include('components.head.css')
    </head>
    <body>
        <header>
            @include('components.header.nav')
        </header>
        <main class="pt-5 pb-5 container">
            @include('components.errors')
            @include('components.messages')
            @yield('main')
        </main>
        <footer>

        </footer>
        @include('components.footer.js')
    </body>
</html>