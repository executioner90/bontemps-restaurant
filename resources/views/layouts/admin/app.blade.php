<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('admin.partials.layout.head')

<body class="font-sans antialiased">
<div class="flex-col w-full md:flex md:flex-row md:min-h-screen">
    @include('admin.partials.layout.sidebar')

    <main class="m-2 p-8 w-full">
        @if (isset($breadcrumbs))
            <x-frontend.header.breadcrumbs :breadcrumbs="$breadcrumbs" />
        @endif

        @include('admin.partials.layout.feedback')

        <div class="py-12">
            @yield('content')
        </div>
    </main>
</div>
</body>
</html>
