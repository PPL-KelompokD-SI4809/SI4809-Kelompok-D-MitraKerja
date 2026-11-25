@extends('layouts.app')

@section('title', 'Dashboard Pencari Kerja - MitraKerja')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Dashboard Pencari Kerja</h1>
    <p>Selamat datang, {{ auth()->user()->name }}! Anda login sebagai <strong>Pencari Kerja</strong>.</p>
    <a href="{{ route('jobseeker.profile.edit') }}" class="mt-6 inline-flex rounded-xl bg-[#0062E3] px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#0062E3]">Lengkapi Profil</a>
</div>
@endsection
