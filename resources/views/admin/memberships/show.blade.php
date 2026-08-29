@extends('admin.layout')

@section('title', 'Detail Pendaftaran')

@section('content')

<a href="{{ route('admin.memberships.index') }}"
   class="mb-5 inline-flex items-center gap-1.5 text-sm font-medium text-neutral-500 hover:text-neutral-800">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    Kembali ke daftar pendaftaran
</a>

<div class="max-w-3xl overflow-hidden rounded-xl border border-neutral-200 bg-white">
    <div class="flex items-center justify-between border-b border-neutral-200 px-6 py-4">
        <h1 class="font-display text-lg font-semibold text-neutral-950">Detail Pendaftaran Anggota</h1>
        <x-admin.status-badge :status="$membership->status" />
    </div>

    @if($membership->photo)
    <div class="border-b border-neutral-200 px-6 py-4">
        <img src="{{ $membership->photo }}" alt="{{ $membership->full_name }}" class="h-28 w-28 rounded-lg object-cover">
    </div>
    @endif

    <dl class="divide-y divide-neutral-100">
        <div class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-neutral-400">Data Diri</div>
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Nama Lengkap</dt>
            <dd class="col-span-2 text-sm font-medium text-neutral-950">{{ $membership->full_name }} @if($membership->nickname) ({{ $membership->nickname }}) @endif</dd>
        </div>
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">NIK</dt>
            <dd class="col-span-2 text-sm text-neutral-800">{{ $membership->nik }}</dd>
        </div>
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Tempat, Tanggal Lahir</dt>
            <dd class="col-span-2 text-sm text-neutral-800">{{ $membership->birth_place }}, {{ $membership->birth_date->format('d-m-Y') }}</dd>
        </div>
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Jenis Kelamin</dt>
            <dd class="col-span-2 text-sm text-neutral-800">{{ $membership->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}</dd>
        </div>
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">WhatsApp</dt>
            <dd class="col-span-2 text-sm text-neutral-800">{{ $membership->whatsapp }}</dd>
        </div>
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Email</dt>
            <dd class="col-span-2 text-sm text-neutral-800">{{ $membership->email }}</dd>
        </div>
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Alamat Domisili</dt>
            <dd class="col-span-2 text-sm text-neutral-800">{{ $membership->address }}</dd>
        </div>
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Provinsi / Kota</dt>
            <dd class="col-span-2 text-sm text-neutral-800">{{ $membership->province }} / {{ $membership->city }}</dd>
        </div>
        @if($membership->social_media)
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Media Sosial</dt>
            <dd class="col-span-2 text-sm text-neutral-800">{{ $membership->social_media }}</dd>
        </div>
        @endif

        <div class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-neutral-400">Latar Belakang</div>
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Pendidikan Terakhir</dt>
            <dd class="col-span-2 text-sm text-neutral-800">{{ $membership->lastEducationLabel() }} @if($membership->education_institution) — {{ $membership->education_institution }} @endif</dd>
        </div>
        @if($membership->occupation)
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Pekerjaan / Profesi</dt>
            <dd class="col-span-2 text-sm text-neutral-800">{{ $membership->occupation }} @if($membership->company) — {{ $membership->company }} @endif</dd>
        </div>
        @endif
        @if($membership->expertise)
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Bidang Keahlian</dt>
            <dd class="col-span-2 text-sm text-neutral-800">{{ $membership->expertise }}</dd>
        </div>
        @endif
        @if($membership->organizations)
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Organisasi/Komunitas</dt>
            <dd class="col-span-2 rounded-lg bg-neutral-50 p-3 text-sm text-neutral-700">{{ $membership->organizations }}</dd>
        </div>
        @endif
        @if($membership->leadership_experience)
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Pengalaman Kepemimpinan</dt>
            <dd class="col-span-2 rounded-lg bg-neutral-50 p-3 text-sm text-neutral-700">{{ $membership->leadership_experience }}</dd>
        </div>
        @endif
        @if($membership->social_experience)
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Pengalaman Sosial/Kemanusiaan</dt>
            <dd class="col-span-2 rounded-lg bg-neutral-50 p-3 text-sm text-neutral-700">{{ $membership->social_experience }}</dd>
        </div>
        @endif
        @if($membership->international_experience)
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Pengalaman Internasional</dt>
            <dd class="col-span-2 rounded-lg bg-neutral-50 p-3 text-sm text-neutral-700">{{ $membership->international_experience }}</dd>
        </div>
        @endif

        <div class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-neutral-400">Motivasi</div>
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Alasan Bergabung</dt>
            <dd class="col-span-2 rounded-lg bg-neutral-50 p-3 text-sm text-neutral-700">{{ $membership->motivation_reason }}</dd>
        </div>
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Pengetahuan tentang MVP.N</dt>
            <dd class="col-span-2 rounded-lg bg-neutral-50 p-3 text-sm text-neutral-700">{{ $membership->mvpn_knowledge }}</dd>
        </div>
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Kontribusi</dt>
            <dd class="col-span-2 rounded-lg bg-neutral-50 p-3 text-sm text-neutral-700">{{ $membership->contribution }}</dd>
        </div>
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Isu Pembangunan yang Diminati</dt>
            <dd class="col-span-2 rounded-lg bg-neutral-50 p-3 text-sm text-neutral-700">{{ $membership->interest_issue }}</dd>
        </div>
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Visi terhadap Generasi Muda</dt>
            <dd class="col-span-2 rounded-lg bg-neutral-50 p-3 text-sm text-neutral-700">{{ $membership->vision_youth }}</dd>
        </div>

        <div class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-neutral-400">Bidang Minat</div>
        <div class="grid grid-cols-3 gap-4 px-6 py-3">
            <dt class="text-sm text-neutral-500">Bidang Dipilih</dt>
            <dd class="col-span-2 flex flex-wrap gap-1.5">
                @foreach($membership->interestFieldLabels() as $label)
                    <span class="rounded-full bg-primary-50 px-2.5 py-1 text-xs font-medium text-primary-600">{{ $label }}</span>
                @endforeach
            </dd>
        </div>
    </dl>

    <div class="flex flex-wrap gap-3 border-t border-neutral-200 px-6 py-4">
        @if($membership->status === 'pending')
        <form method="POST" action="{{ route('admin.memberships.verify', $membership->id) }}">
            @csrf
            <button class="inline-flex items-center gap-1.5 rounded-lg bg-sky-600 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-sky-700">
                Verifikasi
            </button>
        </form>
        @endif

        @if($membership->status === 'verified')
        <form method="POST" action="{{ route('admin.memberships.interview', $membership->id) }}">
            @csrf
            <button class="inline-flex items-center gap-1.5 rounded-lg bg-gold-500 px-4 py-2 text-sm font-semibold text-navy-900 transition-colors hover:bg-gold-600">
                Undang Interview
            </button>
        </form>
        @endif

        @if(in_array($membership->status, ['verified', 'interview']))
        <form method="POST" action="{{ route('admin.memberships.accept', $membership->id) }}">
            @csrf
            <button class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-emerald-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                Terima
            </button>
        </form>
        @endif

        @if(! in_array($membership->status, ['accepted', 'rejected']))
        <form method="POST" action="{{ route('admin.memberships.reject', $membership->id) }}" class="ml-auto">
            @csrf
            <button class="inline-flex items-center gap-1.5 rounded-lg border border-primary-300 px-4 py-2 text-sm font-semibold text-primary-600 transition-colors hover:bg-primary-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                Tolak
            </button>
        </form>
        @endif

        <form method="POST" action="{{ route('admin.memberships.destroy', $membership->id) }}" data-confirm="Hapus pendaftaran ini?">
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
