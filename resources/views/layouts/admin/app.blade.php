<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('admin.partials.layout.head')
</head>

<body class="font-sans antialiased">
<div class="flex-col w-full md:flex md:flex-row md:min-h-screen">
    @include('admin.partials.layout.sidebar')

    <main class="m-2 p-8 w-full">
        @include('admin.partials.layout.feedback')

        @yield('content')
    </main>
</div>
</body>
</html>
