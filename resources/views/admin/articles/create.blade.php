@extends('admin.layout')

@section('title', 'Tambah Artikel')

@section('content')

<a href="{{ route('admin.artikel.index') }}"
   class="mb-5 inline-flex items-center gap-1.5 text-sm font-medium text-neutral-500 hover:text-neutral-800">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    Kembali ke daftar artikel
</a>

<div class="mb-5">
    <h1 class="font-display text-2xl font-semibold text-neutral-950">Tambah Artikel</h1>
    <p class="mt-1 text-sm text-neutral-500">Pilih salah satu: tulis artikel sendiri, atau tambahkan liputan dari media eksternal.</p>
</div>

<div class="grid grid-cols-1 items-start gap-5 lg:grid-cols-2">
    @include('admin.articles._own-form')
    @include('admin.articles._external-form')
</div>

@endsection
