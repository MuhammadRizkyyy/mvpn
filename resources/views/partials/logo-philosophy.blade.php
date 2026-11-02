@php
    $philosophyItems = __('philosophy.items');
    $philosophyMarkers = [
        ['x' => 52, 'y' => 18, 'path' => 'M260 105 V170 L265 190', 'dot' => [265, 190]],
        ['x' => 87, 'y' => 27, 'path' => 'M435 150 V165 L370 205', 'dot' => [370, 205]],
        ['x' => 68, 'y' => 79, 'path' => 'M340 380 V355 L257 310', 'dot' => [257, 310]],
        ['x' => 88, 'y' => 62, 'path' => 'M425 310 H390 L315 260', 'dot' => [315, 260]],
        ['x' => 14, 'y' => 63, 'path' => 'M70 300 V260 L150 214', 'dot' => [150, 214]],
        ['x' => 15, 'y' => 22, 'path' => 'M90 110 H120 V145 H255 V165', 'dot' => [255, 165]],
    ];
    $philosophyCrops = ['165 160 185 180', '65 165 385 75', '210 250 95 95', '180 230 180 65', '65 160 385 185', '65 150 385 200'];
@endphp

<link rel="stylesheet" href="{{ asset('css/logo-philosophy.css') }}">
<section id="filosofi-logo" class="philosophy" aria-labelledby="philosophy-title">
    <div class="container">
        <header class="philosophy-heading">
            <div>
                <span class="section-eyebrow">{{ __('philosophy.eyebrow') }}</span>
                <h2 id="philosophy-title">{{ __('philosophy.title') }}<br><span>{{ __('philosophy.title_accent') }}</span></h2>
            </div>
            <p>{{ __('philosophy.intro') }}</p>
        </header>

        <div class="philosophy-layout">
            <div class="philosophy-visual">
                <figure class="philosophy-figure" aria-label="{{ __('philosophy.figure_label') }}">
                    <div class="philosophy-diagram">
                        <span class="philosophy-plate-label" aria-hidden="true">MVP.N / 2023</span>
                        <div class="philosophy-orbit" aria-hidden="true"></div>
                        <img class="philosophy-logo" src="{{ asset('assets/img/mvpn.png') }}" width="500" height="500" alt="MVP.N — Muda Visioner Penggerak Nasional" loading="lazy">
                        <svg class="philosophy-connectors" viewBox="0 0 500 500" fill="none" aria-hidden="true">
                            <defs>
                                <marker id="philosophy-arrow" viewBox="0 0 8 8" refX="7" refY="4" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
                                    <path d="M1 1 L7 4 L1 7" />
                                </marker>
                            </defs>
                            @foreach ($philosophyMarkers as $i => $marker)
                                <g data-connector="{{ $i }}" @class(['is-active' => $i === 0])>
                                    <path class="philosophy-line" pathLength="1" d="{{ $marker['path'] }}" marker-end="url(#philosophy-arrow)" />
                                    <circle cx="{{ $marker['dot'][0] }}" cy="{{ $marker['dot'][1] }}" r="8" class="philosophy-point" />
                                    @if ($i === 4)
                                        <rect class="philosophy-guide" x="70" y="170" width="380" height="165" rx="12" />
                                    @elseif ($i === 5)
                                        <path class="philosophy-guide" d="M75 170 V155 H440 V170 M255 145 V345" />
                                    @endif
                                </g>
                            @endforeach
                        </svg>
                        @foreach ($philosophyMarkers as $i => $marker)
                            <a href="#filosofi-item-{{ $i }}" class="philosophy-marker {{ $i === 0 ? 'is-active' : '' }}" data-marker="{{ $i }}" style="--marker-x: {{ $marker['x'] }}%; --marker-y: {{ $marker['y'] }}%" aria-label="{{ sprintf('%02d', $i + 1) }} — {{ $philosophyItems[$i]['title'] }}">
                                {{ sprintf('%02d', $i + 1) }}
                            </a>
                        @endforeach
                        <div class="philosophy-plate-footer" aria-hidden="true"><span>EST. 2023</span><span>SUKABUMI, INDONESIA</span></div>
                    </div>
                    <figcaption>
                        <span class="philosophy-caption-rule" aria-hidden="true"></span>
                        <strong>{{ __('philosophy.identity') }}</strong>
                        <p>{{ __('philosophy.hint') }}</p>
                    </figcaption>
                </figure>
            </div>

            <div class="philosophy-stories">
                @foreach ($philosophyItems as $i => $item)
                    <details id="filosofi-item-{{ $i }}" class="philosophy-item" data-philosophy-item="{{ $i }}" open>
                        <summary>
                            <span class="philosophy-number">{{ sprintf('%02d', $i + 1) }}</span>
                            <span class="philosophy-item-heading"><span class="philosophy-item-title">{{ $item['title'] }}</span><span class="philosophy-keyword">{{ $item['keyword'] }}</span></span>
                            <span class="philosophy-toggle" aria-hidden="true"></span>
                        </summary>
                        <div class="philosophy-item-body">
                            <figure class="philosophy-detail-preview">
                                @php($crop = explode(' ', $philosophyCrops[$i]))
                                <svg viewBox="{{ $philosophyCrops[$i] }}" aria-hidden="true" focusable="false">
                                    <defs>
                                        <clipPath id="philosophy-detail-clip-{{ $i }}">
                                            <rect x="{{ $crop[0] }}" y="{{ $crop[1] }}" width="{{ $crop[2] }}" height="{{ $crop[3] }}" />
                                        </clipPath>
                                    </defs>
                                    <g clip-path="url(#philosophy-detail-clip-{{ $i }})">
                                    <image href="{{ asset('assets/img/mvpn.png') }}" width="500" height="500" />
                                    @if ($i === 4)
                                        <rect class="philosophy-detail-outline" x="70" y="170" width="375" height="165" rx="10" />
                                    @elseif ($i === 5)
                                        <path class="philosophy-detail-outline" d="M75 170 V155 H440 V170 M255 150 V340" />
                                    @else
                                        <circle class="philosophy-detail-focus" cx="{{ $philosophyMarkers[$i]['dot'][0] }}" cy="{{ $philosophyMarkers[$i]['dot'][1] }}" r="{{ $i === 2 ? 16 : 22 }}" />
                                    @endif
                                    </g>
                                </svg>
                                <figcaption>
                                    <span>{{ __('philosophy.detail') }} / {{ sprintf('%02d', $i + 1) }}</span>
                                    <strong>{{ $item['title'] }}</strong>
                                </figcaption>
                            </figure>
                            <p>{{ $item['body'] }}</p>
                            @isset($item['steps'])
                                <ol class="philosophy-steps" aria-label="{{ $item['keyword'] }}">
                                    @foreach ($item['steps'] as $step)
                                        <li>{{ $step }}</li>
                                    @endforeach
                                </ol>
                            @endisset
                        </div>
                    </details>
                @endforeach
            </div>
        </div>

        <div class="philosophy-closing">
            <p>{{ __('philosophy.closing') }}</p>
            <span>{{ __('philosophy.signature') }}</span>
        </div>
    </div>
</section>
<script src="{{ asset('js/logo-philosophy.js') }}" defer></script>
