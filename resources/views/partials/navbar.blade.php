<header class="bg-white border-b border-gray-200 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Brand / Identitas MitraKerja -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-3 group focus:outline-none">
                    <!-- MitraKerja Logo Icon -->
                    <div class="flex-shrink-0">
                        <svg class="h-10 w-auto" viewBox="0 0 48 36" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <!-- Left figure (Blue) -->
                            <circle cx="14" cy="8" r="5" fill="#2563EB"/>
                            <path d="M6 31C6 23 9.5 17 15.5 17C18.2 17 20.6 18.5 22 21" stroke="#2563EB" stroke-width="4.5" stroke-linecap="round"/>
                            <!-- Right figure (Orange) -->
                            <circle cx="28" cy="8" r="5" fill="#F59E0B"/>
                            <path d="M22 21C23.4 18.5 25.8 17 28.5 17C34.5 17 38 23 38 31" stroke="#2563EB" stroke-width="4.5" stroke-linecap="round"/>
                            <!-- Connection link -->
                            <circle cx="22" cy="21" r="2.5" fill="#2563EB"/>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-bold tracking-tight text-blue-900 leading-none">
                            Mitra<span class="text-blue-600">Kerja</span>
                        </span>
                        <span class="text-[11px] text-gray-500 font-medium leading-tight mt-1">
                            Kementerian Ketenagakerjaan<br class="hidden sm:inline"> Republik Indonesia
                        </span>
                    </div>
                </a>
            </div>

            <!-- Navigasi Menu Desktop -->
            <nav class="hidden md:flex items-center gap-8" aria-label="Navigasi Utama">
                <a href="{{ url('/') }}" class="text-sm font-semibold text-blue-600 border-b-2 border-blue-600 pb-1 -mb-1 transition">
                    Beranda
                </a>
                <a href="#lowongan-terbaru" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition">
                    Cari Lowongan
                </a>
                <a href="#cara-kerja" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition">
                    Tentang Kami
                </a>
            </nav>

            <!-- Tombol Aksi (Masuk & Daftar) -->
            <div class="hidden md:flex items-center gap-3">
                <a href="#" class="inline-flex items-center justify-center px-5 py-2 text-sm font-semibold text-blue-600 bg-white border border-blue-600 rounded-lg hover:bg-blue-50 transition">
                    Masuk
                </a>
                <a href="#" class="inline-flex items-center justify-center px-5 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm transition">
                    Daftar
                </a>
            </div>

            <!-- Tombol Mobile Menu Hamburger -->
            <div class="flex md:hidden items-center">
                <button type="button" 
                        onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" 
                        class="p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none" 
                        aria-label="Buka menu navigasi">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Navigasi Menu Mobile (Dropdown) -->
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 bg-white px-4 pt-3 pb-5 space-y-3">
        <a href="{{ url('/') }}" class="block px-3 py-2 rounded-md text-base font-semibold text-blue-600 bg-blue-50">
            Beranda
        </a>
        <a href="#lowongan-terbaru" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">
            Cari Lowongan
        </a>
        <a href="#cara-kerja" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">
            Tentang Kami
        </a>
        <div class="pt-3 border-t border-gray-100 flex flex-col gap-2">
            <a href="#" class="w-full text-center px-4 py-2 border border-blue-600 text-sm font-semibold rounded-lg text-blue-600 hover:bg-blue-50">
                Masuk
            </a>
            <a href="#" class="w-full text-center px-4 py-2 bg-blue-600 text-sm font-semibold rounded-lg text-white hover:bg-blue-700">
                Daftar
            </a>
        </div>
    </div>
</header>

