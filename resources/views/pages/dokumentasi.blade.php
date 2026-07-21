@include('layouts.header')
@php
    $galleries = App\Models\Gallery::latest()->get();
@endphp
<section class="gallery-section">
    <style>
        .gallery-section {
            padding: 80px 0;
            background: #fff;
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

        .gallery-card {
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
            padding: 18px 20px;
        }

        .gallery-body h5 {
            font-weight: 600;
            margin-bottom: 6px;
        }

        .gallery-body p {
            font-size: 14px;
            color: #666;
            margin: 0;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

     <div class="gallery-container">
        <h2 class="section-title">{{ __('site.dokumentasi.title') }}</h2>
        <div class="title-line"></div>

        <div class="gallery-grid">
@foreach($galleries as $item)
    <div class="gallery-card">
        <div class="gallery-img">
            <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}">
        </div>
        <div class="gallery-body">
            <h5>{{ $item->title ?? __('site.dokumentasi.default_title') }}</h5>
            <p>{{ $item->description }}</p>
        </div>
    </div>
@endforeach
</div>

        </div>
    </div>
</section>
@include('layouts.footer')