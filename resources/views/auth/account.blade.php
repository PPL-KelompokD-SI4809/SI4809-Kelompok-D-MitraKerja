<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akun - MitraKerja</title>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 font-sans text-[#0B1A30]">
    @include('partials.auth-header')
    <main class="mx-auto max-w-xl px-4 py-12">
        <section class="rounded-3xl border border-slate-200 bg-white p-8">
            <h1 class="text-2xl font-bold">Akun Anda</h1>
            <p class="mt-4">Anda masuk sebagai {{ auth()->user()->name }}.</p>
            @if (auth()->user()->isJobSeeker())
                <a href="{{ route('dashboard.job_seeker') }}" class="mt-4 inline-flex text-sm font-semibold text-[#0062E3] hover:underline">Buka Dashboard Pencari Kerja</a>
            @else
                <p class="mt-4 text-sm leading-relaxed text-slate-600">Halaman ini menampilkan status sesi akun Anda.</p>
            @endif
            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button class="rounded-xl bg-[#0062E3] px-5 py-3 font-semibold text-white hover:bg-blue-700" type="submit">Keluar</button>
            </form>
        </section>
    </main>
</body>
</html>
