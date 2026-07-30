@extends('admin.layout')

@section('title', 'Pengajuan Kerjasama')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="font-display text-2xl font-semibold text-neutral-950">Pengajuan Kerjasama</h1>
        <p class="mt-1 text-sm text-neutral-500">{{ $partnerships->count() }} pengajuan tercatat.</p>
    </div>
</div>

<div class="overflow-hidden rounded-xl border border-neutral-200 bg-white">
    @if($partnerships->isEmpty())
        <div class="px-5 py-12 text-center">
            <p class="text-sm font-medium text-neutral-800">Belum ada pengajuan kerjasama</p>
            <p class="mt-1 text-sm text-neutral-500">Pengajuan dari formulir kerjasama publik akan muncul di sini.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-neutral-200 text-xs font-semibold uppercase tracking-wide text-neutral-500">
                        <th class="px-5 py-2.5">Institusi</th>
                        <th class="px-5 py-2.5">PIC</th>
                        <th class="px-5 py-2.5">Email</th>
                        <th class="px-5 py-2.5">Status</th>
                        <th class="px-5 py-2.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                @foreach($partnerships as $p)
                    <tr class="hover:bg-neutral-50">
                        <td class="px-5 py-2.5 font-medium text-neutral-950">{{ $p->institution_name }}</td>
                        <td class="px-5 py-2.5 text-neutral-600">{{ $p->pic_name }}</td>
                        <td class="px-5 py-2.5 text-neutral-600">{{ $p->email }}</td>
                        <td class="px-5 py-2.5"><x-admin.status-badge :status="$p->status" /></td>
                        <td class="px-5 py-2.5 text-right">
                            <div class="inline-flex items-center gap-2">
                                <a href="{{ route('admin.partnerships.show', $p->id) }}"
                                   class="inline-flex items-center gap-1 rounded-md border border-neutral-300 px-2.5 py-1.5 text-xs font-medium text-neutral-700 transition-colors hover:border-navy-500 hover:text-navy-500">
                                    Detail
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.partnerships.destroy', $p->id) }}" onsubmit="return confirm('Hapus pengajuan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1 rounded-md border border-primary-300 px-2.5 py-1.5 text-xs font-medium text-primary-600 transition-colors hover:bg-primary-50">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection
