@extends('admin.layout')

@section('title', 'Detail Pengajuan')

@section('content')

<a href="{{ route('admin.partnerships.index') }}"
   class="mb-5 inline-flex items-center gap-1.5 text-sm font-medium text-neutral-500 hover:text-neutral-800">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    Kembali ke daftar pengajuan
</a>

<div class="max-w-2xl overflow-hidden rounded-xl border border-neutral-200 bg-white">
    <div class="flex items-center justify-between border-b border-neutral-200 px-6 py-4">
        <h1 class="font-display text-lg font-semibold text-neutral-950">Detail Pengajuan Kerjasama</h1>
        <x-admin.status-badge :status="$partnership->status" />
    </div>

    <dl class="divide-y divide-neutral-100">
        <div class="grid grid-cols-3 gap-4 px-6 py-3.5">
            <dt class="text-sm text-neutral-500">Nama Institusi</dt>
            <dd class="col-span-2 text-sm font-medium text-neutral-950">{{ $partnership->institution_name }}</dd>
        </div>
        <div class="grid grid-cols-3 gap-4 px-6 py-3.5">
            <dt class="text-sm text-neutral-500">PIC</dt>
            <dd class="col-span-2 text-sm text-neutral-800">{{ $partnership->pic_name }}</dd>
        </div>
        <div class="grid grid-cols-3 gap-4 px-6 py-3.5">
            <dt class="text-sm text-neutral-500">Email</dt>
            <dd class="col-span-2 text-sm text-neutral-800">{{ $partnership->email }}</dd>
        </div>
        <div class="grid grid-cols-3 gap-4 px-6 py-3.5">
            <dt class="text-sm text-neutral-500">Rangkuman Kerjasama</dt>
            <dd class="col-span-2 rounded-lg bg-neutral-50 p-3 text-sm text-neutral-700">{{ $partnership->summary }}</dd>
        </div>
        @if($partnership->proposal_file)
        <div class="grid grid-cols-3 gap-4 px-6 py-3.5">
            <dt class="text-sm text-neutral-500">Proposal</dt>
            <dd class="col-span-2">
                <a href="{{ $partnership->proposal_file_url }}" target="_blank"
                   class="inline-flex items-center gap-1.5 rounded-md border border-neutral-300 px-3 py-1.5 text-xs font-medium text-neutral-700 hover:border-navy-500 hover:text-navy-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Download Proposal
                </a>
            </dd>
        </div>
        @endif
    </dl>

    <div class="flex gap-3 border-t border-neutral-200 px-6 py-4">
        <form method="POST" action="{{ route('admin.partnerships.approve', $partnership->id) }}">
            @csrf
            <button class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-emerald-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                Approve
            </button>
        </form>

        <form method="POST" action="{{ route('admin.partnerships.reject', $partnership->id) }}" class="ml-auto">
            @csrf
            <button class="inline-flex items-center gap-1.5 rounded-lg border border-primary-300 px-4 py-2 text-sm font-semibold text-primary-600 transition-colors hover:bg-primary-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                Reject
            </button>
        </form>

        <form method="POST" action="{{ route('admin.partnerships.destroy', $partnership->id) }}" data-confirm="Hapus pengajuan ini?">
            @csrf
            @method('DELETE')
            <button class="inline-flex items-center gap-1.5 rounded-lg border border-neutral-300 px-4 py-2 text-sm font-semibold text-neutral-600 transition-colors hover:bg-neutral-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                Hapus
            </button>
        </form>
    </div>
</div>

@endsection
