@include('layouts.header')

<style>
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hero {
    min-height: 70vh; /* aman, ga ketiban header */
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.hero-inner h1 {
    opacity: 0;
    animation: fadeUp 1s ease-out forwards;
}

.hero-inner p {
    opacity: 0;
    animation: fadeUp 1s ease-out forwards;
    animation-delay: 0.3s;
}

.global-map {
    position: relative;
    height: 100vh;
    background: #000;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.map-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.35;
    filter: grayscale(100%) contrast(1.1);
}

.map-overlay {
    position: absolute;
    text-align: center;
    color: #fff;
    z-index: 2;
    animation: fadeUp 1s ease forwards;
}

.map-title {
    font-size: clamp(36px, 6vw, 64px);
    font-weight: 800;
    letter-spacing: 1px;
}

.map-subtitle {
    margin-top: 12px;
    font-size: 18px;
    letter-spacing: 3px;
    text-transform: uppercase;
    opacity: 0.85;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.global-map::after {
    content: '';
    position: absolute;
    width: 14px;
    height: 14px;
    background: white;
    border-radius: 50%;
    box-shadow: 0 0 25px rgba(255,255,255,0.9);
    bottom: 38%;
    right: 22%;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.6); opacity: 0.5; }
    100% { transform: scale(1); opacity: 1; }
}
.font { 
    font-family: 'Poppins', sans-serif;
    font-weight: 650;
}
</style>

<section class="global-map">
    <div class="map-overlay">
        <h1 class="map-title">{{ __('site.home.hero_title') }}</h1>
        <p class="map-subtitle">{{ __('site.home.hero_subtitle') }}</p>
    </div>

    <img 
        src="{{ asset('assets/img/peta.png') }}"
        alt="Indonesia Global Map"
        class="map-image"
    >
</section>


<
@include('layouts.footer')
