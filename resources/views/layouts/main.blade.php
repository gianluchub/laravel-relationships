<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel posts</title>
  
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @yield('head')
        
    </head>
    <body>
        
        <div class="container">
            <header class="my-5">
                @yield('header')
            </header>

            <main>
                @yield('content')
            </main>

            <footer class="my-5">
                @yield('footer')
            </footer>
        </div>

    </body>
</html>