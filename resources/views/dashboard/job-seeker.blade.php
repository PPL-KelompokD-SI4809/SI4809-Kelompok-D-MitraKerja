@extends('layouts.app')

@section('title', 'Dashboard Pencari Kerja - MitraKerja')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Dashboard Pencari Kerja</h1>
    <p>Selamat datang, {{ auth()->user()->name }}! Anda login sebagai <strong>Pencari Kerja</strong>.</p>
</div>
@endsection
