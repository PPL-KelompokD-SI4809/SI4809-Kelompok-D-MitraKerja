@extends('layouts.app')

@section('title', 'MitraKerja - Peluang Kerja untuk Masa Depan yang Lebih Baik')

@section('content')

{{-- ============================================================ --}}
{{-- 1. HERO SECTION (Konsep JejakKota: Full Hero Background +   --}}
{{--    Dark Navy Overlay & Palet Resmi Kementerian)              --}}
{{-- ============================================================ --}}
<section id="hero"
         class="relative bg-[#071324] overflow-hidden border-b border-gray-900/40">

    {{-- Foto Gedung Kementerian Ketenagakerjaan RI (Resolusi Tinggi & Tajam) --}}
    <div class="absolute inset-0 pointer-events-none z-0 overflow-hidden">
        <img src="{{ asset('images/kemnaker-hero-bg.jpg') }}"
             alt="Gedung Kementerian Ketenagakerjaan Republik Indonesia"
             class="w-full h-full object-cover object-center"
             loading="eager">
        {{-- Gradient Overlay Ala Konsep JejakKota (Disesuaikan ke Color Palette Kemnaker: Deep Navy) --}}
        <div class="absolute inset-0 bg-gradient-to-r from-[#071324]/95 via-[#071324]/80 to-[#071324]/40"></div>
        {{-- Gradient Halus Bawah --}}
        <div class="absolute inset-x-0 bottom-0 h-12 bg-gradient-to-t from-[#071324]/50 to-transparent"></div>
    </div>

    {{-- Konten Utama Hero --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-12 sm:py-16 lg:py-20">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8">

            {{-- Kolom Kiri: Teks & Search Bar --}}
            <div class="max-w-2xl">

                {{-- Eyebrow / Tagline Resmi --}}
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/20 border border-blue-400/30 text-blue-300 text-xs font-semibold tracking-wider uppercase mb-3.5">
                    <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                    PLATFORM RESMI KEMENTERIAN KETENAGAKERJAAN
                </div>

                {{-- Judul Utama --}}
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-[1.16] tracking-tight mb-3">
                    Peluang Kerja untuk<br>
                    <span class="text-[#38BDF8]">Masa Depan yang Lebih Baik</span>
                </h1>

                {{-- Deskripsi --}}
                <p class="text-xs sm:text-sm lg:text-[15px] text-slate-200 leading-relaxed max-w-xl mb-6">
                    Temukan pekerjaan yang sesuai dengan keahlian dan minat Anda, dan wujudkan karir impian bersama MitraKerja.
                </p>

                {{-- Search Bar MitraKerja (Dipertahankan Fungsional & Nyaman Sesuai Permintaan) --}}
                <div class="max-w-xl">
                    <form id="hero-search-form"
                          onsubmit="handleSearch(event)"
                          class="flex items-center bg-white rounded-2xl shadow-[0_10px_35px_rgba(0,0,0,0.35)] p-1.5 focus-within:ring-4 focus-within:ring-blue-500/30 transition-all border border-white/20">
                        {{-- Icon --}}
                        <div class="pl-3.5 pr-1.5 text-gray-400 flex items-center flex-shrink-0">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        {{-- Input --}}
                        <input type="text"
                               id="search-input"
                               name="q"
                               placeholder="Cari lowongan, posisi, atau perusahaan..."
                               autocomplete="off"
                               oninput="handleLiveFilter(this.value)"
                               class="flex-grow text-xs sm:text-sm text-[#0B1A30] placeholder-gray-400 bg-transparent py-2.5 px-2 focus:outline-none min-w-0 font-medium">
                        {{-- Clear button --}}
                        <button type="button"
                                id="btn-clear-search"
                                onclick="clearSearch()"
                                class="hidden p-1 mr-1 text-gray-400 hover:text-gray-600 rounded-full hover:bg-gray-100 transition cursor-pointer flex-shrink-0"
                                title="Hapus pencarian">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                        {{-- Tombol Cari --}}
                        <button type="submit"
                                class="px-6 py-2.5 bg-[#0062E3] hover:bg-blue-700 active:scale-95 text-white font-semibold text-xs sm:text-sm rounded-xl shadow-md transition flex-shrink-0 cursor-pointer">
                            Cari
                        </button>
                    </form>

                    {{-- Pencarian Populer --}}
                    <div class="flex items-center gap-2 mt-3 flex-wrap text-xs text-slate-300">
                        <span class="text-slate-400">Pencarian populer:</span>
                        <button type="button" onclick="quickSearch('Staff Administrasi')" class="px-2.5 py-1 rounded-full bg-white/10 hover:bg-white/20 border border-white/10 text-slate-200 transition cursor-pointer">Staff Administrasi</button>
                        <button type="button" onclick="quickSearch('IT Support')" class="px-2.5 py-1 rounded-full bg-white/10 hover:bg-white/20 border border-white/10 text-slate-200 transition cursor-pointer">IT Support</button>
                        <button type="button" onclick="quickSearch('Marketing')" class="px-2.5 py-1 rounded-full bg-white/10 hover:bg-white/20 border border-white/10 text-slate-200 transition cursor-pointer">Marketing</button>
                        <button type="button" onclick="quickSearch('Operator Produksi')" class="px-2.5 py-1 rounded-full bg-white/10 hover:bg-white/20 border border-white/10 text-slate-200 transition cursor-pointer">Operator Produksi</button>
                    </div>
                </div>

            </div>

            {{-- Kolom Kanan: Floating Landmark Badge (Sesuai Konsep JejakKota "LOKASI JEJAK: Gedung Sate") --}}
        <div class="hidden lg:flex items-center gap-3 px-4 py-3 rounded-2xl bg-[#0B1A30]/90 border border-white/15 shadow-2xl text-white flex-shrink-0 mb-1">
                <div class="w-9 h-9 rounded-xl bg-blue-500/25 border border-blue-400/30 flex items-center justify-center text-blue-400 flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div class="text-left leading-tight">
                    <p class="text-[10px] text-blue-300 uppercase font-semibold tracking-wider">KANTOR PUSAT</p>
                    <p class="text-xs font-bold text-white">Gedung Kemnaker RI, Jakarta</p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- 2. CARA KERJA MITRAKERJA                                     --}}
{{-- ============================================================ --}}
<section id="cara-kerja" class="py-12 sm:py-16 bg-white border-b border-gray-100/80 relative overflow-hidden">

    {{-- Aksen Dekoratif Background --}}
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        {{-- Dot grid sudut kanan atas --}}
        <div class="absolute top-8 right-10 opacity-[0.08]" style="display:grid;grid-template-columns:repeat(5,1fr);gap:14px;">
            @for($i=0;$i<20;$i++)<div class="w-1.5 h-1.5 rounded-full bg-[#0062E3]"></div>@endfor
        </div>
        {{-- Dot grid sudut kiri bawah --}}
        <div class="absolute bottom-12 left-10 opacity-[0.06]" style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;">
            @for($i=0;$i<12;$i++)<div class="w-1.5 h-1.5 rounded-full bg-[#0062E3]"></div>@endfor
        </div>
        {{-- Soft glow --}}
        <div class="absolute -top-20 right-1/4 w-72 h-72 rounded-full bg-blue-200/30 blur-2xl"></div>
        <div class="absolute -bottom-16 left-1/3 w-56 h-56 rounded-full bg-amber-100/25 blur-2xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Header --}}
        <div class="text-center mb-10">
            <p class="text-[11px] font-bold text-[#0062E3] uppercase tracking-widest mb-2">
                CARA KERJA MITRAKERJA
            </p>
            <h2 class="text-2xl sm:text-3xl lg:text-[34px] font-extrabold text-[#0B1A30] tracking-tight leading-tight">
                Langkah Mudah Menuju Peluang Kerja
            </h2>
            <p class="text-sm text-[#64748B] mt-2 max-w-lg mx-auto">Tiga langkah sederhana untuk memulai perjalanan karier Anda bersama MitraKerja.</p>
        </div>

        {{-- 3 Langkah --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">

            {{-- Langkah 01 --}}
            <div class="relative z-10 bg-white rounded-2xl border border-gray-200 shadow-[0_4px_20px_rgba(0,0,0,0.05)] hover:shadow-xl hover:border-blue-300 transition-all duration-300 p-6 sm:p-7 text-center group cursor-default">
                <div class="w-14 h-14 rounded-2xl bg-[#EBF3FF] flex items-center justify-center mx-auto mb-5 border border-blue-100">
                    <svg class="w-7 h-7 text-[#0062E3]" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                    </svg>
                </div>
                <span class="inline-block text-xs font-bold text-[#0062E3] bg-[#EBF3FF] px-3 py-1 rounded-full mb-3 tracking-wide">LANGKAH 01</span>
                <h3 class="text-base sm:text-lg font-extrabold text-[#0B1A30] mb-2">Lengkapi Profil</h3>
                <p class="text-xs sm:text-sm text-[#64748B] leading-relaxed">
                    Buat profil Anda dengan data diri, keahlian, dan pengalaman kerja.
                </p>
            </div>

            {{-- Langkah 02 --}}
            <div class="relative z-10 bg-white rounded-2xl border border-gray-200 shadow-[0_4px_20px_rgba(0,0,0,0.05)] hover:shadow-xl hover:border-amber-300 transition-all duration-300 p-6 sm:p-7 text-center group cursor-default">
                <div class="w-14 h-14 rounded-2xl bg-[#FEF6E6] flex items-center justify-center mx-auto mb-5 border border-amber-100">
                    <svg class="w-7 h-7 text-[#F59E0B]" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a8 8 0 1 0 5.293 14.707l5 5a1 1 0 0 0 1.414-1.414l-5-5A8 8 0 0 0 10 2zm-6 8a6 6 0 1 1 12 0 6 6 0 0 1-12 0z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <span class="inline-block text-xs font-bold text-[#F59E0B] bg-[#FEF6E6] px-3 py-1 rounded-full mb-3 tracking-wide">LANGKAH 02</span>
                <h3 class="text-base sm:text-lg font-extrabold text-[#0B1A30] mb-2">Pencocokan Otomatis</h3>
                <p class="text-xs sm:text-sm text-[#64748B] leading-relaxed">
                    Sistem kami akan mencocokkan profil Anda dengan lowongan yang tersedia.
                </p>
            </div>

            {{-- Langkah 03 --}}
            <div class="relative z-10 bg-white rounded-2xl border border-gray-200 shadow-[0_4px_20px_rgba(0,0,0,0.05)] hover:shadow-xl hover:border-emerald-300 transition-all duration-300 p-6 sm:p-7 text-center group cursor-default">
                <div class="w-14 h-14 rounded-2xl bg-[#E8F8F0] flex items-center justify-center mx-auto mb-5 border border-emerald-100">
                    <svg class="w-7 h-7 text-[#10B981]" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 6h-4V4c0-1.11-.89-2-2-2h-4c-1.11 0-2 .89-2 2v2H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-6 0h-4V4h4v2z"/>
                    </svg>
                </div>
                <span class="inline-block text-xs font-bold text-[#10B981] bg-[#E8F8F0] px-3 py-1 rounded-full mb-3 tracking-wide">LANGKAH 03</span>
                <h3 class="text-base sm:text-lg font-extrabold text-[#0B1A30] mb-2">Peluang Kerja</h3>
                <p class="text-xs sm:text-sm text-[#64748B] leading-relaxed">
                    Dapatkan rekomendasi lowongan terbaik sesuai dengan kriteria Anda.
                </p>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- 3. LOWONGAN TERBARU (Spacing Rapat & Compact)                --}}
{{-- ============================================================ --}}
<section id="lowongan-terbaru" class="py-8 sm:py-10 bg-[#F8FAFC] relative overflow-hidden">

    {{-- Aksen Dekoratif Background --}}
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        {{-- Dot grid sudut kiri atas --}}
        <div class="absolute top-10 left-8 opacity-[0.07]" style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;">
            @for($i=0;$i<16;$i++)<div class="w-1.5 h-1.5 rounded-full bg-[#0B1A30]"></div>@endfor
        </div>
        {{-- Dot grid sudut kanan bawah --}}
        <div class="absolute bottom-8 right-10 opacity-[0.06]" style="display:grid;grid-template-columns:repeat(5,1fr);gap:14px;">
            @for($i=0;$i<15;$i++)<div class="w-1.5 h-1.5 rounded-full bg-[#0062E3]"></div>@endfor
        </div>
        {{-- Soft glow --}}
        <div class="absolute -top-20 left-1/3 w-80 h-80 rounded-full bg-blue-100/25 blur-2xl"></div>
        <div class="absolute -bottom-16 right-1/4 w-60 h-60 rounded-full bg-sky-100/30 blur-2xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Header & Badge & Lihat Semua --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
            <div>
                <p class="text-[11px] font-bold text-[#334155] uppercase tracking-widest mb-1">
                    LOWONGAN TERBARU
                </p>
                <div class="flex items-center gap-2.5 flex-wrap">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0B1A30] tracking-tight">
                        Temukan Peluang Kerja
                    </h2>
                    <span id="job-count-badge"
                          class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-[#EBF3FF] text-[#0062E3] border border-blue-100">
                        4 Lowongan
                    </span>
                </div>
            </div>
            <button type="button"
                    onclick="resetAllFilters()"
                    class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-[#0062E3] hover:text-blue-800 transition group cursor-pointer flex-shrink-0">
                Lihat Semua Lowongan
                <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </button>
        </div>

        {{-- Filter Dropdown --}}
        <div class="flex flex-wrap items-center gap-2 mb-5">
            <span class="text-xs text-gray-500 font-medium">Filter :</span>

            <button type="button"
                    onclick="filterByTag('all')"
                    data-tag="all"
                    class="filter-btn inline-flex items-center gap-1 px-3 py-1 rounded-lg text-xs font-semibold bg-[#0062E3] text-white shadow-xs transition cursor-pointer">
                Semua
                <svg class="w-3 h-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <button type="button"
                    onclick="filterByTag('Full Time')"
                    data-tag="Full Time"
                    class="filter-btn inline-flex items-center gap-1 px-3 py-1 rounded-lg text-xs font-semibold bg-white border border-gray-200 text-gray-600 hover:border-[#0062E3] hover:text-[#0062E3] transition cursor-pointer shadow-xs">
                Full Time
                <svg class="w-3 h-3 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <button type="button"
                    onclick="filterByTag('Onsite')"
                    data-tag="Onsite"
                    class="filter-btn inline-flex items-center gap-1 px-3 py-1 rounded-lg text-xs font-semibold bg-white border border-gray-200 text-gray-600 hover:border-[#0062E3] hover:text-[#0062E3] transition cursor-pointer shadow-xs">
                Onsite
                <svg class="w-3 h-3 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <button type="button"
                    onclick="filterByTag('Hybrid')"
                    data-tag="Hybrid"
                    class="filter-btn inline-flex items-center gap-1 px-3 py-1 rounded-lg text-xs font-semibold bg-white border border-gray-200 text-gray-600 hover:border-[#0062E3] hover:text-[#0062E3] transition cursor-pointer shadow-xs">
                Hybrid
                <svg class="w-3 h-3 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <button type="button"
                    onclick="filterByTag('Shift')"
                    data-tag="Shift"
                    class="filter-btn inline-flex items-center gap-1 px-3 py-1 rounded-lg text-xs font-semibold bg-white border border-gray-200 text-gray-600 hover:border-[#0062E3] hover:text-[#0062E3] transition cursor-pointer shadow-xs">
                Shift
                <svg class="w-3 h-3 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
        </div>

        {{-- Data Lowongan --}}
        @php
            $lowonganList = [
                [
                    'id'         => 1,
                    'perusahaan' => 'PT Nusantara Jaya',
                    'logo'       => 'nusantara-jaya',
                    'lokasi'     => 'Jakarta Selatan',
                    'posisi'     => 'Staff Administrasi',
                    'tipe'       => 'Full Time',
                    'sistem'     => 'On-site',
                    'gaji'       => 'Rp 5.500.000 – Rp 7.000.000',
                    'pendidikan' => 'D3 / S1 Semua Jurusan',
                    'pengalaman' => 'Minimal 1 tahun',
                    'deskripsi'  => 'Mengelola dokumen administrasi kantor, pengarsipan berkas digital, pembuatan surat resmi, serta rekonsiliasi data operasional harian perusahaan.',
                ],
                [
                    'id'         => 2,
                    'perusahaan' => 'PT Solusi Digital',
                    'logo'       => 'solusi-digital',
                    'lokasi'     => 'Bandung',
                    'posisi'     => 'IT Support',
                    'tipe'       => 'Full Time',
                    'sistem'     => 'Hybrid',
                    'gaji'       => 'Rp 6.000.000 – Rp 8.500.000',
                    'pendidikan' => 'D3 / S1 Teknik Informatika / Sistem Informasi',
                    'pengalaman' => 'Minimal 1–2 tahun',
                    'deskripsi'  => 'Bertanggung jawab atas pemeliharaan perangkat keras, jaringan LAN/WLAN, troubleshooting sistem operasi, instalasi software, dan bantuan teknis internal.',
                ],
                [
                    'id'         => 3,
                    'perusahaan' => 'PT Karya Mandiri',
                    'logo'       => 'karya-mandiri',
                    'lokasi'     => 'Surabaya',
                    'posisi'     => 'Marketing Officer',
                    'tipe'       => 'Part Time',
                    'sistem'     => 'Hybrid',
                    'gaji'       => 'Rp 5.000.000 – Rp 7.500.000 + Insentif',
                    'pendidikan' => 'SMA / SMK / D3 / S1',
                    'pengalaman' => 'Fresh Graduate dipersilakan',
                    'deskripsi'  => 'Mengembangkan strategi pemasaran produk, menjalin komunikasi dengan klien potensial, menyusun penawaran bisnis, dan mencapai target penjualan perusahaan.',
                ],
                [
                    'id'         => 4,
                    'perusahaan' => 'PT Sumber Rezeki',
                    'logo'       => 'sumber-rezeki',
                    'lokasi'     => 'Yogyakarta',
                    'posisi'     => 'Operator Produksi',
                    'tipe'       => 'Full Time',
                    'sistem'     => 'Shift',
                    'gaji'       => 'Rp 4.000.000 – Rp 5.200.000',
                    'pendidikan' => 'SMA / SMK Sederajat',
                    'pengalaman' => 'Tidak diutamakan (Pelatihan disediakan)',
                    'deskripsi'  => 'Mengoperasikan mesin manufaktur sesuai SOP keselamatan kerja (K3), melakukan pemeriksaan kualitas barang hasil produksi, dan pelaporan harian.',
                ],
            ];
        @endphp

        {{-- Grid Kartu Lowongan --}}
        <div id="job-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($lowonganList as $item)
                <div class="job-card bg-white rounded-xl border border-gray-200 shadow-[0_2px_12px_rgba(0,0,0,0.06)] hover:shadow-xl hover:border-blue-400 hover:-translate-y-1 transition-all duration-200 flex flex-col cursor-pointer group"
                     data-id="{{ $item['id'] }}"
                     data-title="{{ strtolower($item['posisi']) }}"
                     data-company="{{ strtolower($item['perusahaan']) }}"
                     data-location="{{ strtolower($item['lokasi']) }}"
                     data-tags="{{ $item['tipe'] }},{{ $item['sistem'] }}"
                     onclick="openJobDetailModal({{ json_encode($item, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) }})">

                    <div class="p-4 flex-grow">
                        {{-- Logo & Nama Perusahaan --}}
                        <div class="flex items-center gap-2.5 mb-3">
                            <div class="w-10 h-10 rounded-lg overflow-hidden flex-shrink-0 bg-white border border-gray-100 shadow-xs flex items-center justify-center">
                                <img src="{{ asset('images/company-' . $item['logo'] . '.png') }}"
                                     alt="Logo {{ $item['perusahaan'] }}"
                                     class="w-full h-full object-contain">
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-bold text-[#0F172A] truncate leading-tight">
                                    {{ $item['perusahaan'] }}
                                </p>
                                <div class="flex items-center gap-1 text-[11px] text-gray-500 mt-0.5">
                                    <svg class="w-3 h-3 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="truncate">{{ $item['lokasi'] }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Posisi --}}
                        <h3 class="text-sm sm:text-[15px] font-extrabold text-[#0B1A30] leading-snug">
                            {{ $item['posisi'] }}
                        </h3>
                    </div>

                    {{-- Footer Card: Badge & Tombol --}}
                    <div class="px-4 pb-4 pt-2.5 border-t border-gray-50 flex items-center justify-between gap-2">
                        <div class="flex items-center gap-1.5 flex-wrap">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10.5px] font-semibold bg-[#EBF3FF] text-[#0062E3]">
                                {{ $item['tipe'] }}
                            </span>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10.5px] font-semibold bg-[#EBF3FF] text-[#0062E3]">
                                {{ $item['sistem'] }}
                            </span>
                        </div>
                        <div class="w-6 h-6 rounded-full bg-[#EBF3FF] text-[#0062E3] group-hover:bg-[#0062E3] group-hover:text-white flex items-center justify-center transition-colors flex-shrink-0">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        {{-- Empty state --}}
        <div id="no-jobs-found" class="hidden mt-4 text-center py-10 bg-white rounded-xl border border-gray-200/80">
            <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-blue-50 flex items-center justify-center text-[#0062E3]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <h3 class="text-base font-bold text-gray-900 mb-1">Lowongan Tidak Ditemukan</h3>
            <p class="text-xs text-gray-500 mb-3 max-w-md mx-auto">
                Tidak ada lowongan dengan kata kunci "<span id="empty-query-text" class="font-semibold text-gray-800"></span>".
            </p>
            <button type="button"
                    onclick="resetAllFilters()"
                    class="px-5 py-2 rounded-lg bg-[#0062E3] text-white text-xs font-semibold hover:bg-blue-700 transition cursor-pointer">
                Tampilkan Semua Lowongan
            </button>
        </div>

    </div>
</section>

{{-- ============================================================ --}}
{{-- 4. TENTANG KAMI (Tentang MitraKerja & Sinergi Kemnaker RI)    --}}
{{-- ============================================================ --}}
<section id="tentang-kami" class="py-12 sm:py-16 bg-[#E9EEF5] border-y border-slate-200/80 relative overflow-hidden">

    {{-- Aksen Dekoratif Background --}}
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        {{-- Dot grid sudut kanan atas --}}
        <div class="absolute top-10 right-12 opacity-[0.07]" style="display:grid;grid-template-columns:repeat(5,1fr);gap:16px;">
            @for($i=0;$i<20;$i++)<div class="w-1.5 h-1.5 rounded-full bg-[#0B1A30]"></div>@endfor
        </div>
        {{-- Dot grid sudut kiri bawah --}}
        <div class="absolute bottom-14 left-10 opacity-[0.06]" style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;">
            @for($i=0;$i<12;$i++)<div class="w-1.5 h-1.5 rounded-full bg-[#334155]"></div>@endfor
        </div>
        {{-- Soft glow --}}
        <div class="absolute -bottom-20 left-1/4 w-72 h-72 rounded-full bg-blue-300/15 blur-2xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Header Section & Narasi Utama --}}
        <div class="max-w-7xl mx-auto mb-12">
            {{-- Judul --}}
            <div class="text-center mb-8">
                <p class="text-[11px] font-bold text-[#0062E3] uppercase tracking-widest mb-2">
                    TENTANG KAMI
                </p>
                <h2 class="text-3xl sm:text-4xl lg:text-[42px] font-extrabold text-[#0B1A30] tracking-tight leading-tight">
                    Membangun Ekosistem Ketenagakerjaan<br class="hidden sm:inline"> yang Lebih Baik
                </h2>
            </div>

            {{-- Narasi dalam card putih --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-8 lg:p-10">
                <div class="space-y-4 text-sm sm:text-[15px] text-[#475569] leading-relaxed">
                    <p class="text-[#1E293B] font-medium text-base sm:text-[16px]">
                        MitraKerja merupakan platform portal lowongan kerja yang hadir untuk membantu mempertemukan pencari kerja dengan perusahaan secara lebih mudah, efektif, dan transparan.
                    </p>
                    <div class="w-12 h-[2px] bg-[#0062E3]/30 rounded-full"></div>
                    <p>
                        Sebagai platform yang mendukung upaya peningkatan akses informasi ketenagakerjaan di Indonesia, MitraKerja selaras dengan semangat Kementerian Ketenagakerjaan Republik Indonesia (Kemnaker) dalam memperluas kesempatan kerja dan menciptakan ekosistem ketenagakerjaan yang lebih baik.
                    </p>
                    <p>
                        Melalui MitraKerja, pencari kerja dapat menemukan peluang karier yang sesuai, sementara perusahaan dapat menjangkau talenta potensial untuk memenuhi kebutuhan tenaga kerja.
                    </p>
                </div>
            </div>
        </div>

        {{-- 3 Kolom Nilai Utama (Kartu Putih Kontras Tinggi di Atas Background Abu Muda) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">

            {{-- Card 01 --}}
            <div class="bg-white rounded-2xl p-6 sm:p-7 border border-slate-200/80 shadow-sm hover:border-blue-300 hover:shadow-md transition-all duration-200 flex flex-col justify-between group">
                <div>
                    <span class="text-3xl sm:text-4xl font-extrabold text-[#0062E3] font-mono leading-none block mb-4">
                        01
                    </span>
                    <h3 class="text-sm sm:text-base font-bold text-[#0B1A30] tracking-wider uppercase mb-2">
                        Mudah & Efektif
                    </h3>
                    <p class="text-xs sm:text-sm text-[#64748B] leading-relaxed">
                        Membantu mempertemukan pencari kerja dengan perusahaan secara lebih mudah, cepat, dan transparan.
                    </p>
                </div>
            </div>

            {{-- Card 02 --}}
            <div class="bg-white rounded-2xl p-6 sm:p-7 border border-slate-200/80 shadow-sm hover:border-amber-300 hover:shadow-md transition-all duration-200 flex flex-col justify-between group">
                <div>
                    <span class="text-3xl sm:text-4xl font-extrabold text-[#F59E0B] font-mono leading-none block mb-4">
                        02
                    </span>
                    <h3 class="text-sm sm:text-base font-bold text-[#0B1A30] tracking-wider uppercase mb-2">
                        Sinergi Kemnaker RI
                    </h3>
                    <p class="text-xs sm:text-sm text-[#64748B] leading-relaxed">
                        Selaras dengan semangat Kementerian Ketenagakerjaan RI dalam memperluas kesempatan kerja nasional.
                    </p>
                </div>
            </div>

            {{-- Card 03 --}}
            <div class="bg-white rounded-2xl p-6 sm:p-7 border border-slate-200/80 shadow-sm hover:border-emerald-300 hover:shadow-md transition-all duration-200 flex flex-col justify-between group">
                <div>
                    <span class="text-3xl sm:text-4xl font-extrabold text-[#10B981] font-mono leading-none block mb-4">
                        03
                    </span>
                    <h3 class="text-sm sm:text-base font-bold text-[#0B1A30] tracking-wider uppercase mb-2">
                        Peluang Karier & Talenta
                    </h3>
                    <p class="text-xs sm:text-sm text-[#64748B] leading-relaxed">
                        Pencari kerja menemukan peluang karier yang sesuai, perusahaan menjangkau talenta potensial terbaik.
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>

{{-- ============================================================ --}}
{{-- 5. BANNER PERUSAHAAN (Bersih, Rapi & Tanpa Duplikasi Gambar) --}}
{{-- ============================================================ --}}
<section id="banner-perusahaan" class="py-10 sm:py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#dbeafe] via-[#eff6ff] to-[#e0edff] border border-blue-200/60 shadow-xs p-7 sm:p-9 lg:p-11">

            {{-- Dekorasi Aksen Vektor Halus (Bukan Gambar Bitmap yang Menduplikasi) --}}
            <div class="absolute -right-10 -top-10 w-60 h-60 rounded-full bg-blue-300/20 blur-2xl pointer-events-none" aria-hidden="true"></div>
            <div class="absolute right-24 -bottom-12 w-48 h-48 rounded-full bg-blue-400/15 blur-xl pointer-events-none" aria-hidden="true"></div>

            <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                {{-- Teks --}}
                <div class="max-w-xl">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-100 text-[#0062E3] text-[11px] font-bold uppercase tracking-wider mb-2.5">
                        Kemitraan Perusahaan
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0B1A30] tracking-tight mb-2">
                        Untuk Perusahaan
                    </h2>
                    <p class="text-xs sm:text-sm text-[#475569] leading-relaxed">
                        Pasang lowongan kerja, temukan kandidat yang sesuai, dan kelola proses rekrutmen dengan mudah.
                    </p>
                </div>

                {{-- CTA Tunggal --}}
                <div class="flex-shrink-0 w-full md:w-auto">
                    <button type="button"
                            onclick="showToast('Pendaftaran pemberi kerja belum tersedia pada versi ini.', false)"
                            class="w-full md:w-auto inline-flex items-center justify-center gap-2.5 px-7 py-3.5 bg-[#0062E3] hover:bg-blue-700 active:scale-95 text-white font-semibold text-xs sm:text-sm rounded-xl shadow-md hover:shadow-lg transition cursor-pointer">
                        <span>Daftar sebagai Pemberi Kerja</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ============================================================ --}}
{{-- MODAL 1: DETAIL LOWONGAN                                     --}}
{{-- ============================================================ --}}
<div id="job-modal"
     class="hidden fixed inset-0 z-50"
     role="dialog"
     aria-modal="true"
     aria-labelledby="job-modal-title">

    {{-- Backdrop --}}
    <div class="fixed inset-0 bg-gray-900/55" onclick="closeJobModal()"></div>

    <div class="relative min-h-full flex items-center justify-center p-4 sm:p-6">
        <div class="relative w-full max-w-2xl bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">

            {{-- Tombol Tutup --}}
            <button type="button"
                    onclick="closeJobModal()"
                    class="absolute top-5 right-5 p-2 rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition cursor-pointer z-10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <div class="p-6 sm:p-8">
                {{-- Header --}}
                <div class="flex items-start gap-4 mb-6 pr-8">
                    <div class="w-14 h-14 rounded-2xl bg-white border border-gray-100 p-1 flex-shrink-0 shadow-sm flex items-center justify-center">
                        <img id="modal-company-logo" src="" alt="" class="w-full h-full object-contain">
                    </div>
                    <div class="min-w-0 flex-grow">
                        <div class="flex items-center gap-2 flex-wrap mb-1">
                            <h4 id="modal-company-name" class="text-sm font-bold text-gray-700"></h4>
                            <span class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-100">
                                <svg class="w-3 h-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Terverifikasi
                            </span>
                        </div>
                        <h3 id="job-modal-title" class="text-xl sm:text-2xl font-extrabold text-[#0B1A30] leading-tight"></h3>
                        <div class="flex flex-wrap items-center gap-3 text-xs text-gray-500 mt-2">
                            <span id="modal-job-location" class="flex items-center gap-1"></span>
                            <span id="modal-job-salary" class="font-semibold text-[#0062E3]"></span>
                        </div>
                    </div>
                </div>

                {{-- Badges --}}
                <div class="flex flex-wrap items-center gap-2 py-3.5 border-y border-gray-100 mb-6">
                    <span id="modal-badge-tipe" class="px-3 py-1 rounded-lg text-xs font-semibold bg-[#EBF3FF] text-[#0062E3]"></span>
                    <span id="modal-badge-sistem" class="px-3 py-1 rounded-lg text-xs font-semibold bg-[#EBF3FF] text-[#0062E3]"></span>
                    <span class="px-3 py-1 rounded-lg text-xs font-medium bg-gray-100 text-gray-600">Dipublikasikan: Hari ini</span>
                </div>

                {{-- Konten --}}
                <div class="space-y-5 mb-8">
                    <div>
                        <h4 class="text-sm font-bold text-gray-900 mb-2">Deskripsi Pekerjaan</h4>
                        <p id="modal-job-description" class="text-sm text-gray-600 leading-relaxed"></p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-gray-50/80 p-4 rounded-2xl border border-gray-100">
                        <div>
                            <span class="text-xs text-gray-400 font-medium block mb-0.5">Pendidikan Minimal</span>
                            <span id="modal-job-education" class="text-sm font-bold text-gray-800"></span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 font-medium block mb-0.5">Pengalaman Kerja</span>
                            <span id="modal-job-experience" class="text-sm font-bold text-gray-800"></span>
                        </div>
                    </div>
                </div>

                {{-- Aksi --}}
                <div class="flex flex-col sm:flex-row items-center gap-3 pt-5 border-t border-gray-100">
                    <button type="button"
                            id="btn-save-job"
                            onclick="toggleSaveJob()"
                            class="w-full sm:w-auto px-5 py-3 rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50 text-sm font-semibold transition cursor-pointer">
                        Simpan Lowongan
                    </button>
                    <button type="button"
                            onclick="applyJob()"
                            class="w-full sm:w-auto flex-1 px-8 py-3 rounded-xl bg-[#0062E3] hover:bg-blue-700 text-white text-sm font-semibold shadow-sm transition active:scale-95 cursor-pointer">
                        Lamar Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- MODAL 2: AUTENTIKASI (MASUK / DAFTAR)                        --}}
{{-- ============================================================ --}}
<div id="auth-modal"
     class="hidden fixed inset-0 z-50"
     role="dialog"
     aria-modal="true"
     aria-labelledby="auth-modal-title">

    <div class="fixed inset-0 bg-[#071324]/70" onclick="closeAuthModal()"></div>

    <div class="relative min-h-full flex items-center justify-center p-4 sm:p-6">
        <div class="relative w-full max-w-xl overflow-hidden rounded-3xl border border-white/20 bg-white shadow-2xl shadow-slate-950/30">

            <button type="button"
                    onclick="closeAuthModal()"
                    class="absolute top-4 right-4 p-2 rounded-full text-white/70 hover:bg-white/10 hover:text-white transition cursor-pointer z-20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <div class="relative overflow-hidden bg-gradient-to-br from-[#071B38] via-[#0A3267] to-[#0062E3] px-6 py-7 sm:px-8">
                <div class="pointer-events-none absolute -right-12 -top-16 h-44 w-44 rounded-full border-[18px] border-white/10"></div>
                <div class="pointer-events-none absolute bottom-0 left-0 h-20 w-52 bg-gradient-to-r from-sky-300/15 to-transparent"></div>
                <div class="relative pr-8">
                    <p id="auth-modal-eyebrow" class="mb-2 text-[11px] font-bold tracking-[0.16em] text-sky-200">MULAI BERSAMA MITRAKERJA</p>
                    <h3 id="auth-modal-title" class="text-2xl font-extrabold tracking-tight text-white">Pilih peran Anda di MitraKerja</h3>
                    <p id="auth-modal-description" class="mt-2 text-sm leading-relaxed text-blue-100">Pilih jenis akun untuk memulai perjalanan Anda.</p>
                </div>
            </div>

            <div class="p-6 sm:p-8">
                <div class="space-y-3">
                    <button type="button"
                            id="auth-jobseeker-option"
                            onclick="chooseJobSeekerAuth()"
                            class="group flex w-full items-center gap-4 rounded-2xl border border-blue-100 bg-white px-4 py-5 text-left shadow-sm transition hover:border-[#0062E3] hover:bg-blue-50/60 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-blue-100 disabled:cursor-not-allowed disabled:opacity-60 disabled:hover:border-blue-100 disabled:hover:bg-white disabled:hover:shadow-sm">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-[#0062E3] transition-transform group-hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h4 class="text-sm font-bold text-slate-900 transition-colors group-hover:text-[#0062E3]">Pencari Kerja</h4>
                            <p id="auth-jobseeker-copy" class="mt-1 text-xs leading-relaxed text-slate-500">Buat akun untuk mulai mencari peluang kerja.</p>
                        </div>
                        <span id="auth-jobseeker-arrow" class="shrink-0 text-slate-400 transition-transform group-hover:translate-x-1 group-hover:text-[#0062E3]">&rarr;</span>
                    </button>

                    <button type="button"
                            id="auth-employer-option"
                            onclick="chooseEmployerAuth()"
                            class="group flex w-full items-center gap-4 rounded-2xl border border-slate-200 bg-white px-4 py-5 text-left shadow-sm transition hover:border-amber-300 hover:bg-amber-50/40 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-amber-100 disabled:cursor-not-allowed disabled:opacity-60 disabled:hover:border-slate-200 disabled:hover:bg-white disabled:hover:shadow-sm">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-amber-100 text-amber-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h4 class="text-sm font-bold text-slate-700 transition-colors group-hover:text-amber-700">Pemberi Kerja / Perusahaan</h4>
                            <p id="auth-employer-copy" class="mt-1 text-xs leading-relaxed text-slate-500">Pendaftaran perusahaan sedang dipersiapkan.</p>
                        </div>
                        <span class="shrink-0 text-slate-400 transition-transform group-hover:translate-x-1 group-hover:text-amber-600">&rarr;</span>
                    </button>
                </div>

                <p class="mt-5 text-center text-[11px] leading-relaxed text-slate-400">
                    Akses Administrator dikelola secara internal.
                </p>
            </div>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- TOAST NOTIFIKASI                                             --}}
{{-- ============================================================ --}}
<div id="toast-notification"
     class="fixed bottom-6 right-6 z-[60] transform translate-y-24 opacity-0 transition-all duration-300 pointer-events-none"
     aria-live="polite">
    <div class="flex items-center gap-3 bg-[#0F172A] text-white px-5 py-3.5 rounded-2xl shadow-xl text-sm font-medium border border-white/10">
        <span id="toast-icon" class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse flex-shrink-0"></span>
        <span id="toast-message">Notifikasi</span>
    </div>
</div>

@endsection

@push('scripts')
<script>
// ===== State =====
let currentTag    = 'all';
let currentSearch = '';
let currentModalJob  = null;
let savedJobIds   = new Set();
let toastTimer    = null;
let scrollLockState = null;

// Menahan scroll tanpa mengubah lebar area konten ketika scrollbar hilang.
function lockPageScroll() {
    if (scrollLockState) return;

    const body = document.body;
    const currentPadding = Number.parseFloat(window.getComputedStyle(body).paddingRight) || 0;
    const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;

    scrollLockState = {
        overflow: body.style.overflow,
        paddingRight: body.style.paddingRight,
    };

    body.style.overflow = 'hidden';
    if (scrollbarWidth > 0) {
        body.style.paddingRight = `${currentPadding + scrollbarWidth}px`;
    }
}

function unlockPageScroll() {
    if (!scrollLockState) return;

    document.body.style.overflow = scrollLockState.overflow;
    document.body.style.paddingRight = scrollLockState.paddingRight;
    scrollLockState = null;
}

// ===== Toast =====
function showToast(message, isSuccess = true) {
    const toast   = document.getElementById('toast-notification');
    const msgEl   = document.getElementById('toast-message');
    const iconEl  = document.getElementById('toast-icon');

    if (toastTimer) clearTimeout(toastTimer);

    msgEl.textContent = message;
    iconEl.className  = `w-2 h-2 rounded-full flex-shrink-0 animate-pulse ${isSuccess ? 'bg-emerald-400' : 'bg-blue-400'}`;

    toast.classList.remove('translate-y-24', 'opacity-0');
    toast.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');

    toastTimer = setTimeout(() => {
        toast.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
        toast.classList.add('translate-y-24', 'opacity-0', 'pointer-events-none');
    }, 3200);
}

// ===== Search =====
function handleLiveFilter(query) {
    currentSearch = query.trim().toLowerCase();
    const clearBtn = document.getElementById('btn-clear-search');
    if (clearBtn) clearBtn.classList.toggle('hidden', currentSearch.length === 0);
    applyFilters();
}

function handleSearch(e) {
    e.preventDefault();
    const input = document.getElementById('search-input');
    handleLiveFilter(input.value);
    document.getElementById('lowongan-terbaru')?.scrollIntoView({ behavior: 'smooth' });
}

function quickSearch(keyword) {
    const input = document.getElementById('search-input');
    input.value = keyword;
    handleLiveFilter(keyword);
    document.getElementById('lowongan-terbaru')?.scrollIntoView({ behavior: 'smooth' });
    showToast(`Menampilkan: "${keyword}"`);
}

function clearSearch() {
    const input = document.getElementById('search-input');
    input.value = '';
    handleLiveFilter('');
    input.focus();
}

// ===== Filter =====
function filterByTag(tag) {
    currentTag = tag;
    document.querySelectorAll('.filter-btn').forEach(btn => {
        const isActive = btn.dataset.tag === tag;
        if (isActive) {
            btn.className = 'filter-btn inline-flex items-center gap-1 px-3.5 py-1.5 rounded-lg text-xs font-semibold bg-[#0062E3] text-white shadow-sm transition cursor-pointer';
        } else {
            btn.className = 'filter-btn inline-flex items-center gap-1 px-3.5 py-1.5 rounded-lg text-xs font-semibold bg-white border border-gray-200 text-gray-600 hover:border-[#0062E3] hover:text-[#0062E3] transition cursor-pointer shadow-sm';
        }
    });
    applyFilters();
}

function applyFilters() {
    const cards = document.querySelectorAll('.job-card');
    let visibleCount = 0;

    cards.forEach(card => {
        const title    = card.dataset.title    || '';
        const company  = card.dataset.company  || '';
        const location = card.dataset.location || '';
        const tags     = (card.dataset.tags    || '').split(',');

        const matchSearch = currentSearch === '' ||
            title.includes(currentSearch) ||
            company.includes(currentSearch) ||
            location.includes(currentSearch);

        const matchTag = currentTag === 'all' || tags.includes(currentTag);

        if (matchSearch && matchTag) {
            card.classList.remove('hidden');
            visibleCount++;
        } else {
            card.classList.add('hidden');
        }
    });

    const countBadge = document.getElementById('job-count-badge');
    if (countBadge) countBadge.textContent = `${visibleCount} Lowongan`;

    const noJobs = document.getElementById('no-jobs-found');
    const emptyText = document.getElementById('empty-query-text');
    if (noJobs) noJobs.classList.toggle('hidden', visibleCount > 0);
    if (emptyText) emptyText.textContent = currentSearch || currentTag;
}

function resetAllFilters() {
    currentTag    = 'all';
    currentSearch = '';
    const input   = document.getElementById('search-input');
    if (input) input.value = '';
    document.getElementById('btn-clear-search')?.classList.add('hidden');

    document.querySelectorAll('.filter-btn').forEach(btn => {
        if (btn.dataset.tag === 'all') {
            btn.className = 'filter-btn inline-flex items-center gap-1 px-3.5 py-1.5 rounded-lg text-xs font-semibold bg-[#0062E3] text-white shadow-sm transition cursor-pointer';
        } else {
            btn.className = 'filter-btn inline-flex items-center gap-1 px-3.5 py-1.5 rounded-lg text-xs font-semibold bg-white border border-gray-200 text-gray-600 hover:border-[#0062E3] hover:text-[#0062E3] transition cursor-pointer shadow-sm';
        }
    });

    applyFilters();
    document.getElementById('lowongan-terbaru')?.scrollIntoView({ behavior: 'smooth' });
    showToast('Semua lowongan ditampilkan');
}

// ===== Modal Detail Lowongan =====
function openJobDetailModal(job) {
    currentModalJob = job;

    const baseUrl = '{{ asset("images/company-") }}';
    document.getElementById('modal-company-logo').src   = baseUrl + job.logo + '.png';
    document.getElementById('modal-company-logo').alt   = 'Logo ' + job.perusahaan;
    document.getElementById('modal-company-name').textContent = job.perusahaan;
    document.getElementById('job-modal-title').textContent    = job.posisi;
    document.getElementById('modal-job-salary').textContent   = job.gaji;
    document.getElementById('modal-badge-tipe').textContent   = job.tipe;
    document.getElementById('modal-badge-sistem').textContent = job.sistem;
    document.getElementById('modal-job-description').textContent = job.deskripsi;
    document.getElementById('modal-job-education').textContent   = job.pendidikan;
    document.getElementById('modal-job-experience').textContent  = job.pengalaman;

    const locEl = document.getElementById('modal-job-location');
    locEl.innerHTML = `
        <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
        </svg>
        <span>${job.lokasi}</span>`;

    updateSaveButton();
    document.getElementById('job-modal').classList.remove('hidden');
    lockPageScroll();
}

function closeJobModal() {
    document.getElementById('job-modal').classList.add('hidden');
    unlockPageScroll();
}

function toggleSaveJob() {
    if (!currentModalJob) return;
    const id = currentModalJob.id;
    if (savedJobIds.has(id)) {
        savedJobIds.delete(id);
        showToast('Lowongan dihapus dari daftar simpan');
    } else {
        savedJobIds.add(id);
        showToast('Lowongan berhasil disimpan!');
    }
    updateSaveButton();
}

function updateSaveButton() {
    const btn = document.getElementById('btn-save-job');
    if (!btn || !currentModalJob) return;
    if (savedJobIds.has(currentModalJob.id)) {
        btn.textContent = '★ Tersimpan';
        btn.className   = 'w-full sm:w-auto px-5 py-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-700 text-sm font-semibold transition cursor-pointer';
    } else {
        btn.textContent = 'Simpan Lowongan';
        btn.className   = 'w-full sm:w-auto px-5 py-3 rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50 text-sm font-semibold transition cursor-pointer';
    }
}

function applyJob() {
    const posisi = currentModalJob?.posisi || 'lowongan ini';
    closeJobModal();
    showToast(`Lamaran untuk "${posisi}" berhasil dikirim!`);
}

// ===== Pilihan jenis akun =====
let authModalMode = 'daftar';

function openAuthModal(mode) {
    if (mode === 'masuk') {
        window.location.href = '{{ route('login') }}';
        return;
    }
    authModalMode = mode === 'masuk' ? 'masuk' : 'daftar';

    const isRegistration = authModalMode === 'daftar';
    const titleEl = document.getElementById('auth-modal-title');
    const eyebrowEl = document.getElementById('auth-modal-eyebrow');
    const descriptionEl = document.getElementById('auth-modal-description');
    const jobseekerOption = document.getElementById('auth-jobseeker-option');
    const employerOption = document.getElementById('auth-employer-option');
    const jobseekerCopy = document.getElementById('auth-jobseeker-copy');
    const jobseekerArrow = document.getElementById('auth-jobseeker-arrow');

    eyebrowEl.textContent = isRegistration ? 'MULAI BERSAMA MITRAKERJA' : 'AKSES MITRAKERJA';
    titleEl.textContent = isRegistration
        ? 'Pilih peran Anda di MitraKerja'
        : 'Masuk ke MitraKerja';
    descriptionEl.textContent = isRegistration
        ? 'Pilih jenis akun untuk memulai perjalanan Anda.'
        : 'Fitur masuk sedang dipersiapkan. Pilihan peran ditampilkan untuk alur yang akan datang.';

    jobseekerOption.disabled = !isRegistration;
    employerOption.disabled = !isRegistration;
    jobseekerCopy.textContent = isRegistration
        ? 'Buat akun untuk mulai mencari peluang kerja.'
        : 'Akses masuk pencari kerja belum tersedia pada versi ini.';
    jobseekerArrow.classList.toggle('opacity-0', !isRegistration);

    document.getElementById('auth-modal').classList.remove('hidden');
    lockPageScroll();
}

function closeAuthModal() {
    document.getElementById('auth-modal').classList.add('hidden');
    unlockPageScroll();
}

function chooseJobSeekerAuth() {
    if (authModalMode === 'daftar') {
        window.location.href = '{{ route('jobseeker.register') }}';
    }
}

function chooseEmployerAuth() {
    if (authModalMode === 'daftar') {
        closeAuthModal();
        showToast('Pendaftaran pemberi kerja sedang dipersiapkan.', false);
    }
}

// ===== Keyboard ESC =====
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        closeJobModal();
        closeAuthModal();
    }
});
</script>
@endpush
