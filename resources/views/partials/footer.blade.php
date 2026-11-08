<footer class="bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            {{-- Brand / Identitas --}}
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0">
                    <svg class="h-9 w-auto" viewBox="0 0 48 36" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <circle cx="14" cy="8" r="5" fill="#0062E3"/>
                        <path d="M6 31C6 23 9.5 17 15.5 17C18.2 17 20.6 18.5 22 21" stroke="#0062E3" stroke-width="4.5" stroke-linecap="round"/>
                        <circle cx="28" cy="8" r="5" fill="#F59E0B"/>
                        <path d="M22 21C23.4 18.5 25.8 17 28.5 17C34.5 17 38 23 38 31" stroke="#0062E3" stroke-width="4.5" stroke-linecap="round"/>
                        <circle cx="22" cy="21" r="2.5" fill="#0062E3"/>
                    </svg>
                </div>
                <div class="flex flex-col leading-none">
                    <span class="text-[17px] font-bold text-[#0F172A]">
                        Mitra<span class="text-[#0062E3]">Kerja</span>
                    </span>
                    <span class="text-[10px] text-gray-500 font-medium mt-[3px] leading-tight">
                        Kementerian Ketenagakerjaan<br>Republik Indonesia
                    </span>
                </div>
            </div>

            {{-- Tautan Navigasi Footer --}}
            <nav class="flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-gray-500" aria-label="Navigasi Footer">
                <a href="#tentang-kami" class="hover:text-[#0062E3] transition-colors">Tentang Kami</a>
                <a href="#" class="hover:text-[#0062E3] transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-[#0062E3] transition-colors">Syarat dan Ketentuan</a>
                <a href="#" class="hover:text-[#0062E3] transition-colors">Kontak</a>
            </nav>

            {{-- Copyright --}}
            <p class="text-xs text-gray-400 whitespace-nowrap">
                &copy; {{ date('Y') }} MitraKerja. All rights reserved.
            </p>

        </div>
    </div>
</footer>
