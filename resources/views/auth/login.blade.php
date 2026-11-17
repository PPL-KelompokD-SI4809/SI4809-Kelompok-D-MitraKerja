<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - MitraKerja</title>
    <meta name="description" content="Halaman masuk akun MitraKerja.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 font-sans text-slate-800 antialiased">
    @include('partials.auth-header')

    <main class="relative overflow-hidden px-4 py-8 sm:px-6 sm:py-12 lg:py-14">
        <div class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-80 bg-gradient-to-b from-blue-100/80 to-transparent"></div>
        <div class="mx-auto grid max-w-6xl items-stretch gap-7 lg:grid-cols-[minmax(0,0.9fr)_minmax(0,1fr)] lg:gap-10">
            <section class="relative overflow-hidden rounded-[2rem] bg-[#071B38] p-7 shadow-xl shadow-blue-950/15 sm:p-9 lg:p-10">
                <div class="relative flex h-full flex-col">
                    <span class="inline-flex w-fit items-center gap-2 rounded-full border border-blue-300/25 bg-white/10 px-3 py-1 text-xs font-semibold tracking-wide text-blue-100"><span class="h-2 w-2 rounded-full bg-[#38BDF8]"></span>AKSES MITRAKERJA</span>
                    <h1 class="mt-5 text-3xl font-extrabold leading-tight tracking-tight text-white sm:text-4xl">Selangkah lebih dekat dengan peluang Anda.</h1>
                    <p class="mt-4 max-w-md text-sm leading-relaxed text-slate-200 sm:text-base">Satu tempat untuk memulai perjalanan karier dan terhubung dengan dunia kerja.</p>
                    <div class="mt-8 rounded-2xl border border-white/10 bg-white/[0.07] p-5">
                        <h2 class="text-sm font-bold text-white">Selamat datang kembali</h2>
                        <p class="mt-2 text-sm leading-relaxed text-slate-300">Gunakan email dan kata sandi akun MitraKerja Anda saat layanan masuk sudah tersedia.</p>
                    </div>
                    <p class="mt-8 border-t border-white/10 pt-6 text-xs leading-relaxed text-slate-300">Belum punya akun? Mulai dari pendaftaran sebagai pencari kerja.</p>
                </div>
            </section>

            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/60 sm:p-8" aria-labelledby="login-title">
                <h2 id="login-title" class="text-2xl font-extrabold text-[#0B1A30]">Masuk ke MitraKerja</h2>
                <p class="mt-1.5 text-sm text-slate-500">Selamat datang kembali di MitraKerja.</p>
                <p id="login-notice" class="my-6 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm leading-relaxed text-amber-900" role="status">Proses login belum tersedia. Halaman ini masih berupa pratinjau tampilan; email dan kata sandi belum dapat digunakan untuk masuk.</p>

                {{-- UI only: no form submission or credentials sent to a server. --}}
                <div class="space-y-5" aria-describedby="login-notice">
                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Alamat email</label>
                        <input id="email" type="email" autocomplete="username" placeholder="nama@email.com" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#0062E3] focus:ring-4 focus:ring-blue-100">
                    </div>
                    <div>
                        <label for="password" class="mb-1.5 block text-sm font-semibold text-slate-700">Kata sandi</label>
                        <div class="relative">
                            <input id="password" type="password" autocomplete="current-password" placeholder="Masukkan kata sandi Anda" class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-4 pr-14 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#0062E3] focus:ring-4 focus:ring-blue-100">
                            <button id="toggle-password" type="button" aria-controls="password" aria-pressed="false" aria-label="Tampilkan kata sandi" title="Tampilkan kata sandi" class="absolute inset-y-0 right-0 flex w-12 items-center justify-center rounded-xl text-slate-500 hover:bg-blue-50 hover:text-[#0062E3] focus-visible:outline-2 focus-visible:outline-blue-600">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                    <path id="password-eye-slash" d="m3 3 18 18" hidden/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <button type="button" disabled aria-describedby="login-notice" class="inline-flex w-full cursor-not-allowed items-center justify-center rounded-xl bg-[#0062E3] px-5 py-3.5 text-sm font-bold text-white opacity-60">Masuk</button>
                </div>
                <p class="mt-6 text-center text-sm text-slate-500">Belum punya akun? <a href="{{ route('jobseeker.register') }}" class="font-semibold text-[#0062E3] hover:underline">Daftar sebagai pencari kerja</a></p>
            </section>
        </div>
    </main>
    <footer class="border-t border-slate-200 bg-white py-5 text-center text-xs text-slate-500">&copy; {{ date('Y') }} MitraKerja. Platform informasi ketenagakerjaan.</footer>
    <script>
        document.getElementById('toggle-password').addEventListener('click', function () {
            const password = document.getElementById('password');
            const show = password.type === 'password';
            password.type = show ? 'text' : 'password';
            document.getElementById('password-eye-slash').toggleAttribute('hidden', !show);
            this.setAttribute('aria-pressed', String(show));
            this.setAttribute('aria-label', show ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
            this.setAttribute('title', this.getAttribute('aria-label'));
        });
    </script>
</body>
</html>
