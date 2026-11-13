    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex min-h-[72px] max-w-7xl flex-wrap items-center justify-between gap-3 px-4 py-3 sm:px-6 lg:px-8">
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
