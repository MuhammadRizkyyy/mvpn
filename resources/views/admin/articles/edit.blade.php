@extends('admin.layout')

@section('title', 'Edit Artikel')

@section('content')

<a href="{{ route('admin.artikel.index') }}"
   class="mb-5 inline-flex items-center gap-1.5 text-sm font-medium text-neutral-500 hover:text-neutral-800">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    Kembali ke daftar artikel
</a>

<form method="POST" action="{{ route('admin.artikel.update', $article) }}" enctype="multipart/form-data"
      onsubmit="this.querySelector('button[type=submit]').disabled = true;">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 gap-5 lg:grid-cols-[1fr_340px]">
        <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white">
            <div class="border-b border-neutral-200 px-6 py-4">
                <h1 class="font-display text-lg font-semibold text-neutral-950">Edit Artikel</h1>
            </div>

            <div class="space-y-4 px-6 py-5">
                @include('admin.articles._form')
            </div>
        </div>

        @include('admin.articles._external-fields')
    </div>

    <div class="mt-5 flex justify-end gap-3">
        <a href="{{ route('admin.artikel.index') }}"
           class="rounded-lg border border-neutral-300 px-4 py-2 text-sm font-medium text-neutral-700 hover:bg-neutral-50">
            Batal
        </a>
        <button type="submit"
                class="rounded-lg bg-primary-500 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-primary-600">
            Simpan Perubahan
        </button>
    </div>
</form>

@endsection
