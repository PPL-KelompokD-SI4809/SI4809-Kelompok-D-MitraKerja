    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex min-h-[72px] max-w-7xl flex-wrap items-center justify-between gap-3 px-4 py-3 sm:px-6 lg:px-8">
            @include('partials.auth-brand')

            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#0062E3] transition hover:text-blue-800">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m15 18-6-6 6-6"/></svg>
                Kembali ke Beranda
            </a>
        </div>
    </header>
