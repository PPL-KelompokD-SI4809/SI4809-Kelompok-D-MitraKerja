<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - MitraKerja</title>
    <meta name="description" content="Masuk untuk melanjutkan perjalanan karier Anda bersama MitraKerja.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#E2E2E2] font-sans text-[#0B1A30] antialiased">
    <main class="flex min-h-screen items-center justify-center px-4 py-6 sm:px-8 sm:py-10">
        <div class="grid w-full max-w-6xl overflow-hidden rounded-xl bg-white p-3 lg:min-h-[704px] lg:grid-cols-2">
            <section class="relative hidden overflow-hidden rounded-xl lg:flex lg:flex-col lg:justify-between lg:p-6" aria-label="MitraKerja">
                <img src="{{ asset('images/login-abstract.png') }}" alt="" class="absolute inset-0 h-full w-full object-cover">
                <div class="relative z-10 origin-top-left scale-90">@include('partials.auth-brand')</div>
                <div class="pointer-events-none absolute inset-x-0 bottom-0 h-64 bg-gradient-to-t from-white/95 to-transparent"></div>
                <div class="relative z-10 pb-7">
                    <p class="max-w-sm text-2xl font-semibold leading-tight tracking-tight">Langkah baru menuju karier impian.</p>
                    <p class="mt-3 max-w-sm text-sm leading-relaxed text-slate-600">Masuk untuk melanjutkan perjalanan karier Anda bersama MitraKerja.</p>
                </div>
            </section>
            <section class="flex min-w-0 items-center justify-center px-5 py-10 sm:px-10 sm:py-14" aria-labelledby="login-title">
                <div class="flex w-full max-w-[340px] flex-col">
                    <h1 id="login-title" class="text-center text-2xl font-semibold tracking-tight">Selamat datang</h1>
                    @if ($role === null)
                        <p class="mt-2 text-center text-sm text-slate-600">Pilih jenis akun untuk masuk.</p>
                        <div class="mt-7 space-y-3">
                            @foreach ($roles as $value => $label)
                                <a href="{{ route('login', ['role' => $value]) }}" class="flex items-center justify-between gap-3 rounded-xl border border-slate-200 p-4 transition hover:border-blue-300 hover:bg-blue-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                    <span>
                                        <span class="block text-sm font-semibold">{{ $label }}</span>
                                        <span class="mt-1 block text-xs text-slate-600">{{ $value === 'job_seeker' ? 'Untuk Anda yang mencari lowongan.' : 'Untuk perusahaan yang mencari kandidat.' }}</span>
                                    </span>
                                    <span class="shrink-0 text-[#0062E3]" aria-hidden="true">→</span>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="mt-2 text-center text-sm text-slate-600">
                            Masuk sebagai <strong class="font-semibold">{{ strtolower($roles[$role]) }}</strong>
                            <a href="{{ route('login') }}" class="ml-1 font-medium text-[#0062E3] underline underline-offset-4">Ganti</a>
                        </p>
                        <form method="POST" action="{{ route('login.store') }}" class="mt-7 space-y-4" novalidate>
                            @csrf
                            <input type="hidden" name="role" value="{{ $role }}">
                            @error('role')<p class="text-sm text-red-600" role="alert">Pilih jenis akun untuk masuk.</p>@enderror
                            <div>
                                <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Alamat email</label>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="username" required aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" @if($errors->has('email')) aria-describedby="email-error" @endif placeholder="nama@email.com" class="w-full rounded-xl border border-slate-200 px-4 py-3.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-[#0062E3] focus:ring-4 focus:ring-blue-100">
                                @error('email')<p id="email-error" class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Kata sandi</label>
                                <div class="relative">
                                    <input id="password" name="password" type="password" autocomplete="current-password" required aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}" @if($errors->has('password')) aria-describedby="password-error" @endif placeholder="Masukkan kata sandi Anda" class="w-full rounded-xl border border-slate-200 py-3.5 pl-4 pr-14 text-sm outline-none transition placeholder:text-slate-400 focus:border-[#0062E3] focus:ring-4 focus:ring-blue-100">
                                    <button id="toggle-password" type="button" aria-controls="password" aria-pressed="false" aria-label="Tampilkan kata sandi" title="Tampilkan kata sandi" class="absolute inset-y-1 right-1 grid aspect-square cursor-pointer place-items-center rounded-lg text-slate-600 transition hover:bg-slate-100 hover:text-[#0062E3] focus-visible:outline-2 focus-visible:outline-blue-600">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                            <path id="password-eye-slash" d="m3 3 18 18" hidden/>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')<p id="password-error" class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>@enderror
                            </div>
                            <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-[#0062E3] px-5 py-3.5 text-sm font-bold text-white transition hover:bg-blue-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Masuk</button>
                        </form>
                    @endif
                    @if ($role !== 'employer')
                        <p class="mt-6 text-center text-xs leading-relaxed text-slate-500">Belum punya akun? <a href="{{ route('jobseeker.register') }}" class="font-semibold text-[#0062E3] hover:underline">Daftar sebagai pencari kerja</a></p>
                    @endif
                    <a href="{{ route('home') }}" class="mt-5 inline-flex items-center gap-2 self-center rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-[#0062E3]">
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 19-7-7 7-7M5 12h14"/></svg>
                        Kembali ke beranda
                    </a>
                </div>
            </section>
        </div>
    </main>
    <script>
        document.getElementById('toggle-password')?.addEventListener('click', function () {
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
