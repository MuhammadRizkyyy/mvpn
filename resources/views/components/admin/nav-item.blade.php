@props(['href', 'active' => false, 'disabled' => false])

<a href="{{ $disabled ? '#' : $href }}"
   @if($disabled) aria-disabled="true" onclick="return false;" @endif
   class="group mb-0.5 flex items-center gap-3 rounded-lg border-l-2 px-3 py-2 text-sm font-medium transition-colors
   {{ $active
        ? 'border-primary-500 bg-primary-50 text-primary-600'
        : ($disabled
            ? 'border-transparent text-neutral-300 cursor-not-allowed'
            : 'border-transparent text-neutral-500 hover:border-primary-300 hover:bg-neutral-50 hover:text-neutral-800') }}">
    <span class="h-4 w-4 shrink-0 {{ $active ? 'text-primary-500' : ($disabled ? 'text-neutral-300' : 'text-neutral-400 group-hover:text-primary-500') }}">
        {{ $icon }}
    </span>
    <span class="min-w-0 flex-1 truncate">{{ $slot }}</span>
    @isset($trailing){{ $trailing }}@endisset
</a>
