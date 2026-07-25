@props(['text'])
@php
    $words = preg_split('/\s+/u', trim($text));
@endphp
<span {{ $attributes->merge(['class' => 'stagger-wrap']) }}>@foreach($words as $i => $word){{ $i > 0 ? ' ' : '' }}<span class="stagger-word" style="--i:{{ $i }}">{{ $word }}</span>@endforeach</span>
