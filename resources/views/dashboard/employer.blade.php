@extends('layouts.app')

@section('title', 'Dashboard Perusahaan - MitraKerja')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Dashboard Perusahaan</h1>
    <p>Selamat datang, {{ auth()->user()->name }}! Anda login sebagai <strong>Perusahaan</strong>.</p>
</div>
@endsection
