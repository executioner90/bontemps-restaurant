<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('frontend.partials.layout.head')
</head>

<body class="font-sans text-gray-900 antialiased">
@include('frontend.partials.layout.header')

<div class="font-sans text-gray-900 antialiased min-h-screen">
    <div id="app" class="container w-full px-5 py-12 mx-auto">
        @yield('content')
    </div>
</div>

<footer class="bg-gray-800 border-t border-gray-200">
    @include('frontend.partials.layout.footer')
</footer>
</body>
</html>

