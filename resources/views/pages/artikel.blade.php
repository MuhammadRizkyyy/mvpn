@include('layouts.header')

<section class="artikel-page-section">
    <style>
        .artikel-page-section {
            padding: 100px 0 80px;
            background: #fff;
        }

        .artikel-page-header {
            text-align: center;
            max-width: 640px;
            margin: 0 auto 48px;
        }

        .artikel-page-desc {
            color: #666;
            font-size: 1.02rem;
            line-height: 1.7;
            margin-top: 10px;
        }

        .artikel-page-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 360px));
            justify-content: center;
            gap: 28px;
        }

        .artikel-page-card {
            display: block;
            color: inherit;
            text-decoration: none;
            background: #fff;
            border-radius: var(--radius-lg, 22px);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: transform .35s var(--ease-material, ease), box-shadow .35s var(--ease-material, ease);
        }

        .artikel-page-card:hover {
            color: inherit;
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
        }

        .artikel-page-img {
            aspect-ratio: 16 / 10;
            overflow: hidden;
            background: var(--color-navy-50);
        }

        .artikel-page-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top center;
            transition: transform .5s var(--ease-material, ease);
        }

        .artikel-page-card:hover .artikel-page-img img {
            transform: scale(1.06);
        }

        .artikel-page-body {
            padding: 20px 22px 24px;
        }

        .artikel-page-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            flex-wrap: wrap;
        }

        .artikel-badge {
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

        .artikel-date {
            font-size: 0.82rem;
            color: #888;
        }

        .artikel-readmore {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--color-navy-500);
        }

        .artikel-readmore i {
            transition: transform .25s var(--ease-material, ease);
        }

        .artikel-page-card:hover .artikel-readmore i {
            transform: translateX(4px);
        }

        .artikel-page-title {
            font-weight: 700;
            font-size: 1.1rem;
            line-height: 1.4;
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
        }

        .artikel-page-excerpt {
            color: #666;
            font-size: 0.94rem;
            line-height: 1.6;
            margin-bottom: 14px;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            overflow: hidden;
        }

        .artikel-page-empty {
            text-align: center;
            padding: 60px 20px;
            color: #888;
            border: 1px dashed var(--color-navy-100);
            border-radius: var(--radius-lg, 22px);
        }

        .artikel-page-pagination {
            margin-top: 48px;
        }

        .artikel-page-pagination .pagination {
            justify-content: center;
            gap: 4px;
            flex-wrap: wrap;
        }

        .artikel-page-pagination .page-link {
            border: none;
            border-radius: 999px !important;
            min-width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #444;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .artikel-page-pagination .page-link:hover {
            background: var(--color-primary-50);
            color: var(--color-primary-600);
        }

        .artikel-page-pagination .page-item.active .page-link {
            background: var(--color-primary-500);
            color: #fff;
        }

        .artikel-page-pagination .page-item.disabled .page-link {
            background: transparent;
            color: #bbb;
        }

        .artikel-page-pagination .page-link:focus {
            box-shadow: none;
        }
    </style>

    <div class="container">
        <div class="artikel-page-header">
            <span class="section-eyebrow">{{ __('site.nav.artikel') }}</span>
            <h1 class="font">{{ __('site.artikel.title') }}</h1>
            <p class="artikel-page-desc">{{ __('site.artikel.description') }}</p>
        </div>

        @if($articles->isEmpty())
            <div class="artikel-page-empty">{{ __('site.artikel.empty') }}</div>
        @else
            <div class="artikel-page-grid">
                @foreach($articles as $item)
                    <a href="{{ $item->url }}" @if($item->is_external) target="_blank" rel="noopener" @endif class="artikel-page-card">
                        <div class="artikel-page-img">
                            <img src="{{ $item->image }}" alt="{{ $item->title }}" loading="lazy">
                        </div>
                        <div class="artikel-page-body">
                            <div class="artikel-page-meta">
                                <span class="artikel-badge">{{ $item->is_external ? $item->source_name : (\App\Models\Article::CATEGORIES[$item->category] ?? $item->category) }}</span>
                                <span class="artikel-date">{{ $item->published_at?->translatedFormat('d M Y') }}</span>
                            </div>
                            <h3 class="artikel-page-title">{{ $item->title }}</h3>
                            <p class="artikel-page-excerpt">{{ $item->excerpt }}</p>
                            <span class="artikel-readmore">{{ __('site.artikel.read_more') }} <i class="bi {{ $item->is_external ? 'bi-box-arrow-up-right' : 'bi-arrow-right' }}"></i></span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="artikel-page-pagination">
                {{ $articles->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</section>

@include('layouts.footer')
