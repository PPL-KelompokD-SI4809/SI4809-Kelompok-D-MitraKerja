<dialog id="login-role-dialog"
        aria-labelledby="login-role-title"
        aria-describedby="login-role-description"
        class="fixed inset-0 m-auto max-h-[calc(100dvh-2rem)] w-[calc(100%-2rem)] max-w-[440px] overflow-y-auto rounded-2xl bg-white text-[#0B1A30] shadow-xl shadow-slate-950/15 backdrop:bg-slate-950/55">
    <div class="relative p-6">
        <form method="dialog" class="absolute right-3 top-3">
            <button type="submit" autofocus aria-label="Tutup pilihan masuk"
                    class="grid size-10 cursor-pointer place-items-center rounded-lg text-slate-500 transition hover:bg-slate-100 hover:text-[#0B1A30] focus-visible:outline-2 focus-visible:outline-[#0062E3]">
                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" aria-hidden="true"><path d="m6 6 12 12M18 6 6 18"/></svg>
            </button>
        </form>

        <h2 id="login-role-title" class="pr-9 text-2xl font-bold tracking-tight">Masuk sebagai apa?</h2>
        <p id="login-role-description" class="mt-2 text-sm leading-relaxed text-slate-600">Pilih jenis akun untuk masuk ke MitraKerja.</p>

        <div class="mt-5 space-y-3 border-t border-slate-100 pt-5">
            @foreach ([
                ['job_seeker', 'Pencari Kerja', 'Masuk untuk mengakses akun pencari kerja.', '17.5%'],
                ['employer', 'Pemberi Kerja / Perusahaan', 'Masuk untuk mengakses akun perusahaan.', '82%'],
            ] as [$role, $label, $description, $iconPosition])
                <a href="{{ route('login', ['role' => $role]) }}"
                   class="group flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50/70 p-3 transition hover:border-blue-300 hover:bg-blue-50 focus-visible:border-[#0062E3] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#0062E3]">
                    <span class="grid size-11 shrink-0 place-items-center rounded-lg bg-blue-50 group-hover:bg-white" aria-hidden="true">
                        <span class="size-7 bg-no-repeat"
                              style="background-image: url('{{ asset('images/login-role-glyphs.png') }}'); background-size: 400% auto; background-position: {{ $iconPosition }} center;"></span>
                    </span>
                    <span class="min-w-0 flex-1">
                        <span class="block text-sm font-semibold leading-snug">{{ $label }}</span>
                        <span class="mt-1 block text-xs leading-relaxed text-slate-600">{{ $description }}</span>
                    </span>
                    <svg class="size-4 shrink-0 text-[#0062E3] transition-transform group-hover:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                </a>
            @endforeach
        </div>
    </div>
</dialog>
