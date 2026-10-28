@extends('layouts.app')

@section('title', 'MitraKerja - Beranda')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-2xl border border-gray-200 p-8 sm:p-12 text-center shadow-sm">
            <span class="inline-block text-xs font-semibold tracking-wider text-blue-600 uppercase bg-blue-50 px-3 py-1.5 rounded-full mb-4">
                SKM-18: Fondasi Layout Dasar Blade
            </span>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-3">
                Layout Dasar Blade MitraKerja Siap Digunakan
            </h1>
            <p class="text-gray-500 max-w-xl mx-auto text-sm sm:text-base mb-8">
                Navbar di atas dan Footer di bawah sudah terpasang rapi sebagai layout modular (reusable). Area di bawah ini adalah wadah konten utama (<code>@yield('content')</code>) yang siap diisi pada tugas berikutnya.
            </p>

            {{-- Placeholder Kotak Section Sesuai Panduan SKM-18 (Untuk Diisi pada SKM-19) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-left">
                <div class="p-5 border-2 border-dashed border-gray-200 rounded-xl bg-gray-50 text-center flex flex-col items-center justify-center min-h-[120px]">
                    <span class="font-bold text-gray-700 text-sm mb-1">1. Hero Section</span>
                    <span class="text-xs text-gray-400">(Akan diisi di SKM-19)</span>
                </div>
                <div class="p-5 border-2 border-dashed border-gray-200 rounded-xl bg-gray-50 text-center flex flex-col items-center justify-center min-h-[120px]">
                    <span class="font-bold text-gray-700 text-sm mb-1">2. Cara Kerja MitraKerja</span>
                    <span class="text-xs text-gray-400">(Akan diisi di SKM-19)</span>
                </div>
                <div class="p-5 border-2 border-dashed border-gray-200 rounded-xl bg-gray-50 text-center flex flex-col items-center justify-center min-h-[120px]">
                    <span class="font-bold text-gray-700 text-sm mb-1">3. Lowongan Terbaru</span>
                    <span class="text-xs text-gray-400">(Akan diisi di SKM-19)</span>
                </div>
                <div class="p-5 border-2 border-dashed border-gray-200 rounded-xl bg-gray-50 text-center flex flex-col items-center justify-center min-h-[120px]">
                    <span class="font-bold text-gray-700 text-sm mb-1">4. Banner Perusahaan</span>
                    <span class="text-xs text-gray-400">(Akan diisi di SKM-19)</span>
                </div>
            </div>
        </div>
    </div>
@endsection
