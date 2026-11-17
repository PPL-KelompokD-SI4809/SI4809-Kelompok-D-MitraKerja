<header id="main-header" class="bg-white border-b border-gray-100 sticky top-0 z-40 transition-shadow duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-[72px]">

            {{-- ===== Brand / Logo MitraKerja ===== --}}
            <a href="#hero" class="flex items-center gap-3 group focus:outline-none flex-shrink-0">
                {{-- Logo SVG (dua figur manusia, biru + oranye) --}}
                <div class="flex-shrink-0 transition-transform group-hover:scale-105">
                    <svg class="h-9 w-auto" viewBox="0 0 48 36" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        {{-- Figur kiri biru --}}
                        <circle cx="14" cy="8" r="5" fill="#0062E3"/>
                        <path d="M6 31C6 23 9.5 17 15.5 17C18.2 17 20.6 18.5 22 21" stroke="#0062E3" stroke-width="4.5" stroke-linecap="round"/>
                        {{-- Figur kanan oranye --}}
                        <circle cx="28" cy="8" r="5" fill="#F59E0B"/>
                        <path d="M22 21C23.4 18.5 25.8 17 28.5 17C34.5 17 38 23 38 31" stroke="#0062E3" stroke-width="4.5" stroke-linecap="round"/>
                        {{-- Titik koneksi --}}
                        <circle cx="22" cy="21" r="2.5" fill="#0062E3"/>
                    </svg>
                </div>
                <div class="flex flex-col leading-none">
                    <span class="text-[19px] font-bold tracking-tight text-[#0F172A]">
                        Mitra<span class="text-[#0062E3]">Kerja</span>
                    </span>
                    <span class="text-[10.5px] text-gray-500 font-medium mt-[3px] leading-tight">
                        Kementerian Ketenagakerjaan<br>Republik Indonesia
                    </span>
                </div>
            </a>

            {{-- ===== Navigasi Desktop ===== --}}
            <nav class="hidden md:flex items-center gap-8" aria-label="Navigasi Utama">
                <a href="#hero"
                   id="nav-beranda"
                   class="nav-link relative py-1.5 text-sm font-semibold text-[#0062E3] transition-colors group">
                    Beranda
                    <span class="nav-underline absolute bottom-0 left-0 right-0 h-[2.5px] bg-[#0062E3] rounded-full"></span>
                </a>
                <a href="#lowongan-terbaru"
                   id="nav-lowongan"
                   class="nav-link relative py-1.5 text-sm font-medium text-gray-600 hover:text-[#0062E3] transition-colors group">
                    Cari Lowongan
                    <span class="nav-underline absolute bottom-0 left-0 right-0 h-[2.5px] bg-[#0062E3] rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span>
                </a>
                <a href="#tentang-kami"
                   id="nav-tentang"
                   class="nav-link relative py-1.5 text-sm font-medium text-gray-600 hover:text-[#0062E3] transition-colors group">
                    Tentang Kami
                    <span class="nav-underline absolute bottom-0 left-0 right-0 h-[2.5px] bg-[#0062E3] rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span>
                </a>
            </nav>

            {{-- ===== Tombol Masuk & Daftar (Desktop) ===== --}}
            <div class="hidden md:flex items-center gap-3">
                <button type="button"
                        onclick="openAuthModal('masuk')"
                        class="inline-flex items-center justify-center px-5 py-2 text-sm font-semibold text-[#0062E3] bg-white border border-[#0062E3] rounded-lg hover:bg-blue-50 active:scale-95 transition cursor-pointer">
                    Masuk
                </button>
                <button type="button"
                        onclick="openAuthModal('daftar')"
                        class="inline-flex items-center justify-center px-5 py-2 text-sm font-semibold text-white bg-[#0062E3] rounded-lg hover:bg-blue-700 active:scale-95 shadow-sm transition cursor-pointer">
                    Daftar
                </button>
            </div>

            {{-- ===== Hamburger Menu (Mobile) ===== --}}
            <button type="button"
                    id="btn-mobile-menu"
                    onclick="toggleMobileMenu()"
                    class="md:hidden p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none cursor-pointer transition"
                    aria-label="Buka menu navigasi"
                    aria-expanded="false">
                <svg id="icon-hamburger" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="icon-close" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

        </div>
    </div>

    {{-- ===== Dropdown Menu Mobile ===== --}}
    <div id="mobile-menu"
         class="hidden md:hidden bg-white border-t border-gray-100 shadow-lg"
         aria-hidden="true">
        <div class="max-w-7xl mx-auto px-4 py-4 space-y-1">
            <a href="#hero"
               onclick="closeMobileMenu()"
               class="flex items-center gap-2 px-4 py-3 rounded-xl text-sm font-semibold text-[#0062E3] bg-blue-50">
                Beranda
            </a>
            <a href="#lowongan-terbaru"
               onclick="closeMobileMenu()"
               class="flex items-center gap-2 px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                Cari Lowongan
            </a>
            <a href="#tentang-kami"
               onclick="closeMobileMenu()"
               class="flex items-center gap-2 px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                Tentang Kami
            </a>
            <div class="pt-3 mt-2 border-t border-gray-100 flex flex-col gap-2">
                <button type="button"
                        onclick="closeMobileMenu(); openAuthModal('masuk')"
                        class="w-full text-center px-4 py-3 border border-[#0062E3] text-sm font-semibold rounded-xl text-[#0062E3] hover:bg-blue-50 cursor-pointer transition">
                    Masuk
                </button>
                <button type="button"
                        onclick="closeMobileMenu(); openAuthModal('daftar')"
                        class="w-full text-center px-4 py-3 bg-[#0062E3] text-sm font-semibold rounded-xl text-white hover:bg-blue-700 cursor-pointer transition">
                    Daftar
                </button>
            </div>
        </div>
    </div>
</header>

<script>
    // ===== Toggle Mobile Menu =====
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const btn = document.getElementById('btn-mobile-menu');
        const iconHamburger = document.getElementById('icon-hamburger');
        const iconClose = document.getElementById('icon-close');
        const isOpen = !menu.classList.contains('hidden');

        if (isOpen) {
            menu.classList.add('hidden');
            menu.setAttribute('aria-hidden', 'true');
            btn.setAttribute('aria-expanded', 'false');
            iconHamburger.classList.remove('hidden');
            iconClose.classList.add('hidden');
        } else {
            menu.classList.remove('hidden');
            menu.setAttribute('aria-hidden', 'false');
            btn.setAttribute('aria-expanded', 'true');
            iconHamburger.classList.add('hidden');
            iconClose.classList.remove('hidden');
        }
    }

    function closeMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const btn = document.getElementById('btn-mobile-menu');
        const iconHamburger = document.getElementById('icon-hamburger');
        const iconClose = document.getElementById('icon-close');
        if (menu) {
            menu.classList.add('hidden');
            menu.setAttribute('aria-hidden', 'true');
        }
        if (btn) btn.setAttribute('aria-expanded', 'false');
        if (iconHamburger) iconHamburger.classList.remove('hidden');
        if (iconClose) iconClose.classList.add('hidden');
    }

    // ===== Scroll-spy & Navbar Shadow =====
    document.addEventListener('DOMContentLoaded', () => {
        // Tambah shadow saat di-scroll
        const header = document.getElementById('main-header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) {
                header.classList.add('shadow-md');
                header.classList.remove('border-b', 'border-gray-100');
            } else {
                header.classList.remove('shadow-md');
                header.classList.add('border-b', 'border-gray-100');
            }
        });

        // Scroll-spy: update nav active state
        const sections = [
            { id: 'hero',             navId: 'nav-beranda'  },
            { id: 'lowongan-terbaru', navId: 'nav-lowongan' },
            { id: 'tentang-kami',     navId: 'nav-tentang'  },
        ];

        function setActiveNav(activeNavId) {
            sections.forEach(({ navId }) => {
                const link = document.getElementById(navId);
                if (!link) return;
                const underline = link.querySelector('.nav-underline');
                if (navId === activeNavId) {
                    link.classList.add('text-[#0062E3]', 'font-semibold');
                    link.classList.remove('text-gray-600', 'font-medium');
                    if (underline) underline.classList.remove('opacity-0');
                } else {
                    link.classList.remove('text-[#0062E3]', 'font-semibold');
                    link.classList.add('text-gray-600', 'font-medium');
                    if (underline) underline.classList.add('opacity-0');
                }
            });
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const matched = sections.find(s => s.id === entry.target.id);
                    if (matched) setActiveNav(matched.navId);
                }
            });
        }, { rootMargin: '-20% 0px -60% 0px', threshold: 0 });

        sections.forEach(({ id }) => {
            const el = document.getElementById(id);
            if (el) observer.observe(el);
        });
    });
</script>
