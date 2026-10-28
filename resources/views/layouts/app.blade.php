<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'MitraKerja - Platform Lowongan Kerja')</title>

    <!-- Meta Description -->
    <meta name="description" content="Platform resmi Kementerian Ketenagakerjaan Republik Indonesia untuk menghubungkan pencari kerja dan pemberi kerja secara aman dan terpercaya.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Styles & Scripts via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Stack Styles khusus halaman jika dibutuhkan -->
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen flex flex-col selection:bg-blue-600 selection:text-white">
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Konten Utama Halaman -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Stack Scripts khusus halaman jika dibutuhkan -->
    @stack('scripts')
</body>
</html>

