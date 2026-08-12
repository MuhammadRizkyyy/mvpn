@php
    $title = $article->translated('title') . ' — MVP.N';
    $metaDescription = \Illuminate\Support\Str::limit(strip_tags($article->translated('excerpt')), 160);
    $ogImage = $article->image;
    $ogType = 'article';
@endphp
@include('layouts.header')

<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "Article",
    "headline": {!! json_encode($article->translated('title')) !!},
    "description": {!! json_encode(\Illuminate\Support\Str::limit(strip_tags($article->translated('excerpt')), 160)) !!},
    "image": {!! json_encode($article->image) !!},
    "datePublished": "{{ optional($article->published_at)->toAtomString() }}",
    "dateModified": "{{ $article->updated_at->toAtomString() }}",
    "author": {
        "@type": "Organization",
        "name": "MVP.N (Muda Visioner Penggerak Nasional)"
    },
    "publisher": {
        "@type": "Organization",
        "name": "MVP.N (Muda Visioner Penggerak Nasional)",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ asset('assets/img/mvpn.png') }}"
        }
    },
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ route('artikel.show', $article) }}"
    }
}
</script>

<section class="artikel-show-section">
    <style>
        .artikel-show-section {
            padding: 100px 0 80px;
            background: #fff;
        }

        .artikel-show-container {
            max-width: 760px;
            margin: 0 auto;
        }

        .artikel-show-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--color-navy-500);
            text-decoration: none;
            margin-bottom: 24px;
        }

        .artikel-show-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .artikel-show-badge {
            display: inline-block;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            color: var(--color-primary-600);
            background: var(--color-primary-50);
            padding: 4px 12px;
            border-radius: 999px;
        }

        .artikel-show-date {
            font-size: 0.85rem;
            color: #888;
        }

        .artikel-show-title {
            font-size: clamp(1.6rem, 4vw, 2.4rem);
            font-weight: 800;
            line-height: 1.25;
            margin-bottom: 24px;
        }

        .artikel-show-img {
            width: 100%;
            aspect-ratio: 16 / 9;
            border-radius: var(--radius-lg, 22px);
            overflow: hidden;
            margin-bottom: 32px;
            box-shadow: var(--shadow-sm);
        }

        .artikel-show-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .artikel-show-body {
            color: #444;
            font-size: 1.05rem;
            line-height: 1.85;
        }

        .artikel-show-body p {
            margin: 0 0 22px;
        }

        .artikel-show-body p:last-child {
            margin-bottom: 0;
        }

        .artikel-show-body h1,
        .artikel-show-body h2,
        .artikel-show-body h3,
        .artikel-show-body h4 {
            font-weight: 700;
            line-height: 1.35;
            color: #1a1a1a;
            margin: 36px 0 16px;
        }

        .artikel-show-body h1 { font-size: 1.6rem; }
        .artikel-show-body h2 { font-size: 1.4rem; }
        .artikel-show-body h3 { font-size: 1.2rem; }
        .artikel-show-body h4 { font-size: 1.08rem; }

        .artikel-show-body ul,
        .artikel-show-body ol {
            margin: 0 0 22px;
            padding-left: 24px;
        }

        .artikel-show-body li {
            margin-bottom: 8px;
        }

        .artikel-show-body blockquote {
            margin: 28px 0;
            padding: 4px 22px;
            border-left: 3px solid var(--color-primary-500);
            color: #555;
            font-style: italic;
            font-size: 1.08rem;
        }

        .artikel-show-body a {
            color: var(--color-navy-500);
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        .artikel-show-body strong {
            color: #1a1a1a;
        }

        .artikel-related {
            max-width: 1000px;
            margin: 72px auto 0;
            border-top: 1px solid var(--color-navy-100);
            padding-top: 40px;
        }

        .artikel-related-title {
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 24px;
            text-align: center;
        }

        .artikel-related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
        }

        .artikel-related-card {
            display: block;
            color: inherit;
            text-decoration: none;
            background: #fff;
            border-radius: var(--radius-md, 16px);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: transform .3s var(--ease-material, ease), box-shadow .3s var(--ease-material, ease);
        }

        .artikel-related-card:hover {
            color: inherit;
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .artikel-related-img {
            aspect-ratio: 16 / 10;
            overflow: hidden;
            background: var(--color-navy-50);
        }

        .artikel-related-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .artikel-related-body {
            padding: 14px 16px 18px;
        }

        .artikel-related-body h4 {
            font-size: 0.98rem;
            font-weight: 700;
            line-height: 1.4;
        }
    </style>

    <div class="container">
        <div class="artikel-show-container">
            <a href="{{ route('artikel.index') }}" class="artikel-show-back">
                <i class="bi bi-arrow-left"></i> {{ __('site.artikel.back') }}
            </a>

            <div class="artikel-show-meta">
                <span class="artikel-show-badge">{{ \App\Models\Article::CATEGORIES[$article->category] ?? $article->category }}</span>
                <span class="artikel-show-date">{{ $article->published_at?->translatedFormat('d M Y') }}</span>
            </div>

            <h1 class="artikel-show-title">{{ $article->translated('title') }}</h1>

            <div class="artikel-show-img">
                <img src="{{ $article->image }}" alt="{{ $article->translated('title') }}">
            </div>

            <div class="artikel-show-body">{!! $article->translatedContentHtml() !!}</div>
        </div>

        @if($related->isNotEmpty())
            <div class="artikel-related">
                <h2 class="artikel-related-title">{{ __('site.artikel.related') }}</h2>
                <div class="artikel-related-grid">
                    @foreach($related as $item)
                        <a href="{{ $item->url }}" @if($item->is_external) target="_blank" rel="noopener" @endif class="artikel-related-card">
                            <div class="artikel-related-img">
                                <img src="{{ $item->image }}" alt="{{ $item->translated('title') }}" loading="lazy">
                            </div>
                            <div class="artikel-related-body">
                                <h4>{{ $item->translated('title') }}</h4>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

@include('layouts.footer')
