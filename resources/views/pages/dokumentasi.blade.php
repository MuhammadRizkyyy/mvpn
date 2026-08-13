@php
    $title = __('site.dokumentasi.title') . ' — MVP.N';
    $metaDescription = 'Dokumentasi kegiatan dan momen kolaborasi MVP.N (Muda Visioner Penggerak Nasional) bersama mitra, pemerintah, dan komunitas pemuda.';
@endphp
@include('layouts.header')
<section class="gallery-section">
    <style>
        .gallery-section {
            padding: 80px 0;
            background: #fff;
        }

        @media (max-width: 575.98px) {
            .gallery-section {
                padding: 50px 0;
            }
        }

        .gallery-container {
            max-width: 1100px;
            margin: auto;
            padding: 0 20px;
        }

        .section-title {
            text-align: center;
            font-weight: 700;
            font-size: 32px;
            margin-bottom: 8px;
        }

        .title-line {
            width: 60px;
            height: 4px;
            background: #000;
            margin: 0 auto 50px;
            border-radius: 2px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 28px;
        }

        @media (max-width: 400px) {
            .gallery-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        .gallery-card {
            display: flex;
            flex-direction: column;
            height: 100%;
            cursor: pointer;
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.06);
            transition: .35s ease;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeUp .6s ease forwards;
        }

        .gallery-card:nth-child(2) { animation-delay: .1s; }
        .gallery-card:nth-child(3) { animation-delay: .2s; }
        .gallery-card:nth-child(4) { animation-delay: .3s; }
        .gallery-card:nth-child(5) { animation-delay: .4s; }
        .gallery-card:nth-child(6) { animation-delay: .5s; }

        .gallery-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .gallery-img {
            aspect-ratio: 4 / 3;
            overflow: hidden;
            background: #f2f2f2;
        }

        .gallery-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: .4s ease;
        }

        .gallery-card:hover img {
            transform: scale(1.06);
        }

        .gallery-body {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 18px 20px;
        }

        .gallery-body h2 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 6px;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
        }

        .gallery-body p {
            font-size: 14px;
            color: #666;
            margin: 0;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            overflow: hidden;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .lightbox-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 1050;
            background: rgba(0, 0, 0, 0.8);
            padding: 24px;
            align-items: flex-start;
            justify-content: center;
            overflow-y: auto;
        }

        .lightbox-overlay.is-open {
            display: flex;
        }

        .lightbox-box {
            position: relative;
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            max-width: 720px;
            width: 100%;
            margin: auto;
            display: flex;
            flex-direction: column;
        }

        .lightbox-img {
            width: 100%;
            max-height: 60vh;
            flex-shrink: 0;
            background: #f2f2f2;
            object-fit: contain;
        }

        .lightbox-body {
            padding: 20px 24px;
        }

        .lightbox-body h5 {
            font-weight: 700;
            font-size: 20px;
            margin-bottom: 8px;
        }

        .lightbox-description {
            font-size: 14px;
            color: #555;
            line-height: 1.6;
        }

        .lightbox-description p {
            margin: 0 0 8px;
        }

        .lightbox-description p:last-child {
            margin-bottom: 0;
        }

        .lightbox-description ul,
        .lightbox-description ol {
            margin: 0 0 8px;
            padding-left: 20px;
        }

        .lightbox-description a {
            color: #ce1126;
            text-decoration: underline;
        }

        .lightbox-close {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.9);
            font-size: 20px;
            line-height: 1;
            cursor: pointer;
        }

        .lightbox-close:hover {
            background: #fff;
        }

        .gallery-pagination {
            margin-top: 40px;
        }

        .gallery-pagination .pagination {
            justify-content: center;
            gap: 4px;
            flex-wrap: wrap;
        }

        .gallery-pagination .page-link {
            border: none;
            border-radius: 999px !important;
            min-width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .gallery-pagination .page-link:hover {
            background: #FDECEC;
            color: #CE1126;
        }

        .gallery-pagination .page-item.active .page-link {
            background: #CE1126;
            color: #fff;
        }

        .gallery-pagination .page-item.disabled .page-link {
            background: transparent;
            color: #bbb;
        }

        .gallery-pagination .page-link:focus {
            box-shadow: none;
        }
    </style>

     <div class="gallery-container">
        <h1 class="section-title">{{ __('site.dokumentasi.title') }}</h1>
        <div class="title-line"></div>

        <div class="gallery-grid">
@foreach($galleries as $item)
    <div class="gallery-card"
         onclick="openLightbox({{ Js::from(asset('storage/'.$item->image)) }}, {{ Js::from($item->translatedTitle() ?? __('site.dokumentasi.default_title')) }}, {{ Js::from($item->translatedDescriptionHtml()) }})">
        <div class="gallery-img">
            <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->translatedTitle() }}" loading="lazy">
        </div>
        <div class="gallery-body">
            <h2>{{ $item->translatedTitle() ?? __('site.dokumentasi.default_title') }}</h2>
            <p>{{ \Illuminate\Support\Str::limit($item->translatedDescriptionPlain(), 120) }}</p>
        </div>
    </div>
@endforeach
</div>

        @if($galleries->hasPages())
            <div class="gallery-pagination">
                {{ $galleries->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        @endif

        </div>
    </div>
</section>

{{-- LIGHTBOX --}}
<div class="lightbox-overlay" id="lightboxOverlay" onclick="if(event.target === this) closeLightbox()">
    <div class="lightbox-box">
        <button type="button" class="lightbox-close" onclick="closeLightbox()" aria-label="Tutup">&times;</button>
        <img class="lightbox-img" id="lightboxImg" src="" alt="">
        <div class="lightbox-body">
            <h5 id="lightboxTitle"></h5>
            <div id="lightboxDescription" class="lightbox-description"></div>
        </div>
    </div>
</div>

<script>
    function openLightbox(image, title, description) {
        document.getElementById('lightboxImg').src = image;
        document.getElementById('lightboxImg').alt = title;
        document.getElementById('lightboxTitle').textContent = title;
        document.getElementById('lightboxDescription').innerHTML = description || '';
        document.getElementById('lightboxOverlay').classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('lightboxOverlay').classList.remove('is-open');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeLightbox();
    });
</script>

@include('layouts.footer')