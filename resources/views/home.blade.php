@extends('layouts.app')

@section('title', 'MitraKerja - Peluang Kerja untuk Masa Depan yang Lebih Baik')

@section('content')
    {{-- ================================================================= --}}
    {{-- 1. HERO SECTION                                                   --}}
    {{-- ================================================================= --}}
    <section class="relative bg-gradient-to-b from-blue-50/70 via-white to-gray-50/50 pt-10 pb-16 lg:py-20 border-b border-gray-100 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-8 items-center">
                
                {{-- Kolom Kiri: Teks & Form Pencarian --}}
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-100/80 border border-blue-200/60 text-blue-800 text-xs font-semibold tracking-wider uppercase">
                        <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                        Platform Resmi Kementerian Ketenagakerjaan
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight leading-[1.15]">
                        Peluang Kerja untuk <span class="text-blue-600">Masa Depan yang Lebih Baik</span>
                    </h1>

                    <p class="text-base sm:text-lg text-gray-600 leading-relaxed max-w-2xl">
                        MitraKerja menghubungkan pencari kerja dengan peluang kerja yang sesuai melalui pencocokan berbasis kualifikasi secara aman dan terpercaya.
                    </p>

                    {{-- Form Pencarian Lowongan (Struktur UI Sesuai Acuan) --}}
                    <div class="pt-2">
                        <form action="#lowongan-terbaru" method="GET" class="bg-white p-2.5 sm:p-3 rounded-2xl shadow-sm border border-gray-200 hover:border-blue-300 transition-all flex flex-col sm:flex-row gap-2 sm:gap-0 items-stretch sm:items-center">
                            
                            {{-- Input Kata Kunci / Posisi --}}
                            <div class="relative flex-1 flex items-center px-3 py-2 sm:py-1">
                                <svg class="w-5 h-5 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <input type="text" 
                                       name="posisi" 
                                       placeholder="Cari posisi, perusahaan, atau kata kunci..." 
                                       class="w-full text-sm text-gray-800 placeholder-gray-400 bg-transparent focus:outline-none">
                            </div>

                            {{-- Divider vertikal untuk Desktop --}}
                            <div class="hidden sm:block w-px h-8 bg-gray-200 mx-2"></div>

                            {{-- Input Lokasi --}}
                            <div class="relative flex-1 flex items-center px-3 py-2 sm:py-1">
                                <svg class="w-5 h-5 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <input type="text" 
                                       name="lokasi" 
                                       placeholder="Semua lokasi atau kota..." 
                                       class="w-full text-sm text-gray-800 placeholder-gray-400 bg-transparent focus:outline-none">
                            </div>

                            {{-- Tombol Cari Lowongan --}}
                            <button type="submit" 
                                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-xl shadow-sm hover:shadow transition flex-shrink-0 cursor-pointer">
                                <svg class="w-4 h-4 sm:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <span>Cari Lowongan</span>
                            </button>
                        </form>
                    </div>

                    {{-- Info Singkat Tambahan --}}
                    <div class="flex flex-wrap items-center gap-y-2 gap-x-6 text-xs text-gray-500 pt-1">
                        <span class="font-medium text-gray-700">Pencarian Populer:</span>
                        <a href="#lowongan-terbaru" class="hover:text-blue-600 underline-offset-2 hover:underline">Staff Administrasi</a>
                        <a href="#lowongan-terbaru" class="hover:text-blue-600 underline-offset-2 hover:underline">IT Support</a>
                        <a href="#lowongan-terbaru" class="hover:text-blue-600 underline-offset-2 hover:underline">Marketing</a>
                        <a href="#lowongan-terbaru" class="hover:text-blue-600 underline-offset-2 hover:underline">Operator Produksi</a>
                    </div>
                </div>

                {{-- Kolom Kanan: Visual Gedung Kementerian Ketenagakerjaan RI --}}
                <div class="lg:col-span-5 flex justify-center">
                    <div class="relative w-full max-w-lg lg:max-w-none">
                        {{-- Efek Dekoratif Background --}}
                        <div class="absolute -inset-2 bg-gradient-to-tr from-blue-200/40 to-amber-100/40 rounded-3xl blur-lg -z-10"></div>
                        
                        {{-- Container Gambar --}}
                        <div class="rounded-2xl overflow-hidden shadow-md border border-gray-100 bg-white">
                            <img src="{{ asset('images/kemnaker-hero.png') }}" 
                                 alt="Gedung Kementerian Ketenagakerjaan Republik Indonesia" 
                                 class="w-full h-auto object-cover max-h-[380px]"
                                 loading="lazy">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ================================================================= --}}
    {{-- 2. CARA KERJA MITRAKERJA                                          --}}
    {{-- ================================================================= --}}
    <section id="cara-kerja" class="py-16 lg:py-20 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <p class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-2">Cara Kerja MitraKerja</p>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                    Langkah Mudah Menuju Peluang Kerja
                </h2>
                <p class="text-sm sm:text-base text-gray-500 mt-2">
                    Ikuti tiga langkah sederhana untuk terhubung dengan perusahaan impian Anda secara transparan.
                </p>
            </div>

            {{-- Grid 3 Langkah Alur --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 relative">
                
                {{-- Langkah 01 --}}
                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-200 shadow-xs hover:border-blue-200 hover:shadow-sm transition group flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 group-hover:scale-105 transition-transform">
                                {{-- Icon Document / Profil --}}
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <span class="text-2xl font-black text-blue-600/90 font-mono">01</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Lengkapi Profil</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Isi informasi diri, pendidikan, keterampilan, dan pengalaman secara lengkap agar profil Anda mudah dikenali.
                        </p>
                    </div>
                </div>

                {{-- Langkah 02 --}}
                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-200 shadow-xs hover:border-amber-200 hover:shadow-sm transition group flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 group-hover:scale-105 transition-transform">
                                {{-- Icon Pencocokan / Search --}}
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <span class="text-2xl font-black text-amber-500 font-mono">02</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Pencocokan Otomatis</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Sistem mencocokkan profil Anda dengan lowongan yang sesuai berdasarkan kualifikasi dan kompetensi Anda.
                        </p>
                    </div>
                </div>

                {{-- Langkah 03 --}}
                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-200 shadow-xs hover:border-emerald-200 hover:shadow-sm transition group flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 group-hover:scale-105 transition-transform">
                                {{-- Icon Peluang Kerja / Briefcase --}}
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="text-2xl font-black text-emerald-600 font-mono">03</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Peluang Kerja</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Dapatkan rekomendasi lowongan dan lanjut ke proses rekrutmen serta komunikasi langsung bersama perusahaan.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ================================================================= --}}
    {{-- 3. LOWONGAN TERBARU                                               --}}
    {{-- ================================================================= --}}
    <section id="lowongan-terbaru" class="py-16 lg:py-20 bg-gray-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
                <div>
                    <p class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-2">Lowongan Terbaru</p>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                        Temukan Peluang Kerja
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Pilihan lowongan pekerjaan terverifikasi dari berbagai perusahaan rekanan resmi.
                    </p>
                </div>
                <a href="#lowongan-terbaru" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 hover:text-blue-700 transition group self-start sm:self-auto">
                    <span>Lihat Semua Lowongan</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            {{-- Grid Kartu Lowongan Kerja (Contoh Data Lowongan) --}}
            @php
                $lowonganList = [
                    [
                        'perusahaan' => 'PT Nusantara Jaya',
                        'singkatan'  => 'NJ',
                        'lokasi'     => 'Jakarta Selatan',
                        'posisi'     => 'Staff Administrasi',
                        'tipe'       => 'Full Time',
                        'sistem'     => 'Onsite',
                    ],
                    [
                        'perusahaan' => 'PT Solusi Digital',
                        'singkatan'  => 'SD',
                        'lokasi'     => 'Bandung',
                        'posisi'     => 'IT Support',
                        'tipe'       => 'Full Time',
                        'sistem'     => 'Hybrid',
                    ],
                    [
                        'perusahaan' => 'PT Karya Mandiri',
                        'singkatan'  => 'KM',
                        'lokasi'     => 'Surabaya',
                        'posisi'     => 'Marketing Officer',
                        'tipe'       => 'Full Time',
                        'sistem'     => 'Onsite',
                    ],
                    [
                        'perusahaan' => 'PT Sumber Rezeki',
                        'singkatan'  => 'SR',
                        'lokasi'     => 'Yogyakarta',
                        'posisi'     => 'Operator Produksi',
                        'tipe'       => 'Full Time',
                        'sistem'     => 'Shift',
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($lowonganList as $item)
                    <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-xs hover:border-blue-300 hover:shadow-md transition-all duration-200 flex flex-col justify-between group">
                        <div>
                            {{-- Header Card: Logo & Info Perusahaan --}}
                            <div class="flex items-center gap-3.5 mb-4">
                                <div class="w-11 h-11 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center font-bold text-blue-700 text-sm flex-shrink-0">
                                    {{ $item['singkatan'] }}
                                </div>
                                <div class="min-w-0">
                                    <h3 class="text-xs font-bold text-gray-800 truncate leading-tight">{{ $item['perusahaan'] }}</h3>
                                    <div class="flex items-center gap-1 text-[11px] text-gray-500 mt-1">
                                        <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span class="truncate">{{ $item['lokasi'] }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Judul Posisi --}}
                            <h4 class="font-extrabold text-gray-900 text-base sm:text-lg mb-6 leading-snug group-hover:text-blue-600 transition-colors">
                                {{ $item['posisi'] }}
                            </h4>
                        </div>

                        {{-- Footer Card: Badge Jenis Pekerjaan & Tombol Detail --}}
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center gap-1.5 flex-wrap">
                                <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                    {{ $item['tipe'] }}
                                </span>
                                <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
                                    {{ $item['sistem'] }}
                                </span>
                            </div>

                            {{-- Tombol Detail / Arrow --}}
                            <a href="#lowongan-terbaru" 
                               class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 group-hover:bg-blue-600 group-hover:text-white flex items-center justify-center transition-colors flex-shrink-0"
                               title="Lihat detail lowongan">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <p class="text-xs text-center text-gray-400 mt-8">
                * Menampilkan contoh lowongan terverifikasi. Seluruh posisi terbuka untuk pencari kerja yang memenuhi kualifikasi.
            </p>
        </div>
    </section>

    {{-- ================================================================= --}}
    {{-- 4. BANNER PERUSAHAAN                                              --}}
    {{-- ================================================================= --}}
    <section id="banner-perusahaan" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden bg-gradient-to-r from-blue-100 via-blue-50 to-white rounded-3xl p-8 sm:p-12 border border-blue-100 shadow-sm flex flex-col md:flex-row items-center justify-between gap-8">
                
                {{-- Elemen Dekoratif Aksen Halus --}}
                <div class="absolute right-0 top-0 bottom-0 w-1/3 bg-radial from-blue-200/30 to-transparent pointer-events-none"></div>

                {{-- Teks Ajakan Perusahaan --}}
                <div class="relative z-10 max-w-2xl">
                    <span class="inline-block text-xs font-bold text-blue-700 bg-blue-200/50 px-3 py-1 rounded-full uppercase tracking-wider mb-3">
                        Kemitraan Industri
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight mb-3">
                        Untuk Perusahaan
                    </h2>
                    <p class="text-base sm:text-lg text-gray-600 leading-relaxed">
                        Pasang lowongan kerja, temukan kandidat yang sesuai, dan kelola proses rekrutmen dengan mudah melalui sistem yang terintegrasi dengan Kementerian Ketenagakerjaan.
                    </p>
                </div>

                {{-- Tombol Aksi Perusahaan --}}
                <div class="relative z-10 flex-shrink-0 w-full md:w-auto">
                    <a href="#" 
                       class="w-full md:w-auto inline-flex items-center justify-center gap-2.5 px-7 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm sm:text-base rounded-xl shadow-sm hover:shadow transition transform hover:-translate-y-0.5">
                        <span>Daftar sebagai Pemberi Kerja</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>

            </div>
        </div>
    </section>
@endsection
