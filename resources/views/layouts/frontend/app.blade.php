<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.frontend.partials.head')
    </head>

    <body class="font-sans text-gray-900 antialiased">
        @include('layouts.frontend.partials.header')

        <div class="font-sans text-gray-900 antialiased min-h-screen">
            <div class="container w-full px-5 py-20 mx-auto">
                @yield('content')
            </div>
        </div>

        <footer class="bg-gray-800 border-t border-gray-200">
            @include('layouts.frontend.partials.footer')
        </footer>
    </body>
</html>

