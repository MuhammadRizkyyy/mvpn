@props(['status'])

@php
$map = [
    'pending' => ['label' => 'Pending', 'class' => 'bg-gold-100 text-gold-600 border-gold-500/30'],
    'approved' => ['label' => 'Approved', 'class' => 'bg-emerald-50 text-emerald-700 border-emerald-200'],
    'rejected' => ['label' => 'Rejected', 'class' => 'bg-primary-50 text-primary-600 border-primary-300/40'],
    'verified' => ['label' => 'Verified', 'class' => 'bg-sky-50 text-sky-700 border-sky-200'],
    'interview' => ['label' => 'Interview', 'class' => 'bg-gold-100 text-gold-600 border-gold-500/30'],
    'accepted' => ['label' => 'Accepted', 'class' => 'bg-emerald-50 text-emerald-700 border-emerald-200'],
];
$s = $map[$status] ?? ['label' => ucfirst($status), 'class' => 'bg-neutral-100 text-neutral-600 border-neutral-300'];
@endphp

<span class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 text-xs font-medium {{ $s['class'] }}">
    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
    {{ $s['label'] }}
</span>
