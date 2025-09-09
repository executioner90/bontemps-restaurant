<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Administration</title>

    <!-- Favicon for general use (desktop) -->
    <link rel="icon" href="{{ asset('/assets/images/favicons/favicon.ico') }}" type="image/x-icon">

    <!-- Favicon for small tabs (32x32 and 16x16) -->
    <link rel="icon" href="{{ asset('/assets/images/favicons/favicon-32x32.png') }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ asset('/assets/images/favicons/favicon-16x16.png') }}" sizes="16x16" type="image/png">

    <!-- Favicon for Apple Touch devices (iOS) -->
    <link rel="apple-touch-icon" href="{{ asset('/assets/images/favicons/apple-touch-icon.png') }}" sizes="180x180">

    <!-- Favicon for Android devices -->
    <link rel="icon" href="{{ asset('/assets/images/favicons/android-chrome-192x192.png') }}" sizes="192x192" type="image/png">
    <link rel="icon" href="{{ asset('/assets/images/favicons/android-chrome-512x512.png') }}" sizes="512x512" type="image/png">

    <!-- (Optional) Theme color for mobile browsers -->
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/admin/app.css', 'resources/js/app.js'])

</head>
