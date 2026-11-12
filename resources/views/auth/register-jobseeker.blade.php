<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Pencari Kerja - MitraKerja</title>
    <meta name="description" content="Buat akun MitraKerja sebagai pencari kerja.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 font-sans text-slate-800 antialiased">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex h-[72px] max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="Kembali ke beranda MitraKerja">
                <svg class="h-9 w-auto" viewBox="0 0 48 36" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <circle cx="14" cy="8" r="5" fill="#0062E3"/>
                    <path d="M6 31C6 23 9.5 17 15.5 17C18.2 17 20.6 18.5 22 21" stroke="#0062E3" stroke-width="4.5" stroke-linecap="round"/>
                    <circle cx="28" cy="8" r="5" fill="#F59E0B"/>
                    <path d="M22 21C23.4 18.5 25.8 17 28.5 17C34.5 17 38 23 38 31" stroke="#0062E3" stroke-width="4.5" stroke-linecap="round"/>
                    <circle cx="22" cy="21" r="2.5" fill="#0062E3"/>
                </svg>
                <span class="flex flex-col leading-none">
                    <span class="text-[19px] font-bold tracking-tight text-slate-900">Mitra<span class="text-[#0062E3]">Kerja</span></span>
                    <span class="mt-[3px] text-[10.5px] font-medium leading-tight text-slate-500">Kementerian Ketenagakerjaan<br>Republik Indonesia</span>
                </span>
            </a>

            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#0062E3] transition hover:text-blue-800">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m15 18-6-6 6-6"/></svg>
                Kembali ke Beranda
            </a>
        </div>
    </header>

    <main class="relative overflow-hidden px-4 py-8 sm:px-6 sm:py-12 lg:py-14">
        <div class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-80 bg-gradient-to-b from-blue-100/80 to-transparent"></div>
        <div class="mx-auto grid max-w-6xl items-stretch gap-7 lg:grid-cols-[minmax(0,0.9fr)_minmax(0,1fr)] lg:gap-10">
            <section class="relative overflow-hidden rounded-[2rem] bg-[#071B38] p-7 shadow-xl shadow-blue-950/15 sm:p-9 lg:min-h-[636px] lg:p-10">
                <div class="pointer-events-none absolute -right-20 -top-24 h-64 w-64 rounded-full bg-[#0062E3]/40 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-24 -left-16 h-52 w-52 rounded-full bg-cyan-400/15 blur-3xl"></div>

                <div class="relative z-10 flex h-full flex-col">
                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full border border-blue-300/25 bg-white/10 px-3 py-1 text-xs font-semibold tracking-wide text-blue-100">
                            <span class="h-2 w-2 rounded-full bg-[#38BDF8]"></span>
                            AKUN PENCARI KERJA
                        </div>
                        <h1 class="mt-5 text-3xl font-extrabold leading-tight tracking-tight text-white sm:text-4xl">Mulai perjalanan karier Anda bersama MitraKerja.</h1>
                        <p class="mt-4 max-w-md text-sm leading-relaxed text-slate-200 sm:text-base">Buat akun dasar untuk mencari peluang kerja. Data pendidikan, keterampilan, dan pengalaman dapat dilengkapi kemudian pada profil Anda.</p>
                    </div>

                    <div class="mt-8 space-y-3.5">
                        <div class="flex items-start gap-3.5 rounded-2xl border border-white/10 bg-white/[0.07] p-4">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-blue-400/15 text-[#7DD3FC]">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-bold text-white">Mulai dengan data yang sederhana</h2>
                                <p class="mt-1 text-xs leading-relaxed text-slate-300">Cukup gunakan nama, email, dan kata sandi untuk membuat akun awal.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5 rounded-2xl border border-white/10 bg-white/[0.07] p-4">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-blue-400/15 text-[#7DD3FC]">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l2.5 2.5M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"/></svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-bold text-white">Lengkapi profil sesuai waktu Anda</h2>
                                <p class="mt-1 text-xs leading-relaxed text-slate-300">Informasi pendidikan, keterampilan, dan pengalaman tidak diminta pada tahap ini.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5 rounded-2xl border border-white/10 bg-white/[0.07] p-4">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-blue-400/15 text-[#7DD3FC]">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5-5.5a12.1 12.1 0 0 1-16 0V12a8 8 0 0 0 16 0V4.5Z"/></svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-bold text-white">Khusus untuk pencari kerja</h2>
                                <p class="mt-1 text-xs leading-relaxed text-slate-300">Akses Administrator tidak tersedia melalui pendaftaran publik.</p>
                            </div>
                        </div>
                    </div>

                    <p class="mt-auto border-t border-white/10 pt-6 text-xs leading-relaxed text-slate-300">Peran akun ditetapkan oleh sistem agar pendaftaran publik tetap sesuai dengan tujuan penggunaannya.</p>
                </div>
            </section>

            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/60 sm:p-8">
                <div class="mb-7">
                    <h2 class="text-2xl font-extrabold text-[#0B1A30]">Daftar sebagai Pencari Kerja</h2>
                    <p class="mt-1.5 text-sm text-slate-500">Isi data akun Anda untuk memulai.</p>
                </div>

                @if (session('status'))
                    <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="status">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->has('registration'))
                    <div class="mb-5 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm leading-relaxed text-amber-900" role="alert">
                        {{ $errors->first('registration') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('jobseeker.register.store') }}" class="space-y-5" novalidate>
                    @csrf
                    <div>
                        <label for="name" class="mb-1.5 block text-sm font-semibold text-slate-700">Nama lengkap</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required autofocus aria-describedby="name-error" @class(['w-full rounded-xl border px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:ring-4', 'border-red-400 bg-red-50/40 focus:border-red-500 focus:ring-red-100' => $errors->has('name'), 'border-slate-200 bg-white focus:border-[#0062E3] focus:ring-blue-100' => ! $errors->has('name')]) placeholder="Masukkan nama lengkap Anda">
                        @error('name')<p id="name-error" class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Alamat email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required aria-describedby="email-error" @class(['w-full rounded-xl border px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:ring-4', 'border-red-400 bg-red-50/40 focus:border-red-500 focus:ring-red-100' => $errors->has('email'), 'border-slate-200 bg-white focus:border-[#0062E3] focus:ring-blue-100' => ! $errors->has('email')]) placeholder="nama@email.com">
                        @error('email')<p id="email-error" class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password" class="mb-1.5 block text-sm font-semibold text-slate-700">Kata sandi</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required aria-describedby="password-help password-error" @class(['w-full rounded-xl border px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:ring-4', 'border-red-400 bg-red-50/40 focus:border-red-500 focus:ring-red-100' => $errors->has('password'), 'border-slate-200 bg-white focus:border-[#0062E3] focus:ring-blue-100' => ! $errors->has('password')]) placeholder="Minimal 8 karakter">
                        <p id="password-help" class="mt-1.5 text-xs text-slate-500">Gunakan minimal 8 karakter.</p>
                        @error('password')<p id="password-error" class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="mb-1.5 block text-sm font-semibold text-slate-700">Konfirmasi kata sandi</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required placeholder="Ketik ulang kata sandi" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#0062E3] focus:ring-4 focus:ring-blue-100">
                    </div>

                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-[#0062E3] px-5 py-3.5 text-sm font-bold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200 active:scale-[0.99]">
                        Buat Akun Pencari Kerja
                    </button>
                </form>

                <p class="mt-6 text-center text-xs leading-relaxed text-slate-500">Dengan mendaftar, Anda membuat akun sebagai pencari kerja. Akses Administrator hanya dikelola secara internal.</p>
            </section>
        </div>
    </main>

    <footer class="border-t border-slate-200 bg-white py-5 text-center text-xs text-slate-500">
        &copy; {{ date('Y') }} MitraKerja. Platform informasi ketenagakerjaan.
    </footer>
</body>
</html>
