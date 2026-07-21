@include('layouts.header')


@section('content')
<style>
.kemitraan {
    max-width: 1100px;
    margin: 0 auto;
    padding: 60px 30px;
    text-align: center;
}

.kemitraan h1 {
    font-size: clamp(1.5rem, 5vw, 32px);
    margin-bottom: 40px;
    position: relative;
    text-align: center;
    font-weight: bold;
}

@media (max-width: 575.98px) {
    .kemitraan {
        padding: 40px 16px;
    }

    .partner-row img {
        height: 60px;
        max-width: 120px;
    }
}

.partner-section {
    margin-bottom: 60px;
}

.partner-title {
    text-align: center;
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 24px;
}
.partner-row {
    display: flex;
    flex-wrap: wrap;              /* INI KUNCI */
    gap: 30px;
    justify-content: center;      /* bukan space-between */
}

.partner-row img {
    height: 80px;
    max-width: 160px;
    object-fit: contain;
}



.partner-row img:hover {
    filter: grayscale(0);
    opacity: 1;
    transform: scale(1.05);
}

}
</style>

<div class="kemitraan">
    <h1>{{ __('site.mitra.title') }}</h1>

    {{-- MEDIA PARTNER --}}
    <div class="partner-section">
    <div class="partner-title">{{ __('site.mitra.media') }}</div>

    <div class="partner-row">
        <img src="{{ asset('assets/img/MEDIA1.png') }}">
        <img src="{{ asset('assets/img/media2.jpeg') }}">
        <img src="{{ asset('assets/img/media3.jpeg') }}">
        <img src="{{ asset('assets/img/med.png') }}">
    </div>
</div>


    {{-- COMMUNITY PARTNER --}}
    <div class="partner-section">
        <div class="partner-title">{{ __('site.mitra.community') }}</div>
         <div class="partner-row">
        <img src="{{ asset('assets/img/com1-image.jpeg') }}">
        <img src="{{ asset('assets/img/com2-image.jpeg') }}">
        <img src="{{ asset('assets/img/com3-image.jpeg') }}">
        <img src="{{ asset('assets/img/com4-image.jpeg') }}">
        <img src="{{ asset('assets/img/com5-image.jpeg') }}">
        <img src="{{ asset('assets/img/com6-image.png') }}">
    </div>
        </div>
    </div>

    {{-- Government Partnership --}}
    <div class="partner-section">
        <div class="partner-title">{{ __('site.mitra.government') }}</div>
        <div class="partner-row">
        <img src="{{ asset('assets/img/gov1.jpeg') }}">
        <img src="{{ asset('assets/img/gov2.jpeg') }}">
        <img src="{{ asset('assets/img/gov3.png') }}">         
        <img src="{{ asset('assets/img/gov4.jpeg') }}">
        <img src="{{ asset('assets/img/gov5.jpeg') }}">
        <img src="{{ asset('assets/img/gov6.jpeg') }}">
        <img src="{{ asset('assets/img/gov7.jpeg') }}">
        <img src="{{ asset('assets/img/gov8.jpeg') }}">
        <img src="{{ asset('assets/img/gov9.jpeg') }}">
    </div>
        </div>
    </div>

    
    {{-- Hospitality & Campus Partnership --}}
    <div class="partner-section">
        <div class="partner-title">{{ __('site.mitra.hospitality_campus') }}</div>
        <div class="partner-row">
        <img src="{{ asset('assets/img/hc1.jpeg') }}">
        <img src="{{ asset('assets/img/hc5.jpeg') }}">
    </div>
        </div>
    </div>
   
    
    {{-- HOTEL PARTNERSHIP --}}
    <div class="partner-section">
        <div class="partner-title">{{ __('site.mitra.hotel') }}</div>
        <div class="partner-row">
        <img src="{{ asset('assets/img/hotel1.jpeg') }}">
        <img src="{{ asset('assets/img/hotel2.jpeg') }}">
        <img src="{{ asset('assets/img/hotel3.jpeg') }}">
        <img src="{{ asset('assets/img/hotel4.jpeg') }}">
        <img src="{{ asset('assets/img/hotel5.jpeg') }}">
    </div>
        </div>
    </div>

    {{-- Brand Partnership --}}
    <div class="partner-section">
        <div class="partner-title">{{ __('site.mitra.brand') }}</div>
        <div class="partner-row">
        <img src="{{ asset('assets/img/brand1.jpeg') }}">
        <img src="{{ asset('assets/img/brand2.jpeg') }}">
        <img src="{{ asset('assets/img/brand3.jpeg') }}">
        <img src="{{ asset('assets/img/brand4.jpeg') }}">
        <img src="{{ asset('assets/img/brand5.jpeg') }}">
        <img src="{{ asset('assets/img/brand6.jpeg') }}">
        <img src="{{ asset('assets/img/brand7.jpeg') }}">
        <img src="{{ asset('assets/img/brand8.jpeg') }}">
        <img src="{{ asset('assets/img/brand9.jpeg') }}">
        <img src="{{ asset('assets/img/brand10.jpeg') }}">
        <img src="{{ asset('assets/img/brand11.jpeg') }}">
        <img src="{{ asset('assets/img/brand12.jpeg') }}">
        <img src="{{ asset('assets/img/brand13.jpeg') }}">
        <img src="{{ asset('assets/img/brand14.jpeg') }}">
        <img src="{{ asset('assets/img/brand15.jpeg') }}">
        <img src="{{ asset('assets/img/brand16.jpeg') }}">
        <img src="{{ asset('assets/img/brand17.png') }}">
        <img src="{{ asset('assets/img/brand18.png') }}">
        <img src="{{ asset('assets/img/brand19.png') }}">
        <img src="{{ asset('assets/img/brand20.png') }}">
        <img src="{{ asset('assets/img/brand21.png') }}">
        <img src="{{ asset('assets/img/brand22.jpeg') }}">
        <img src="{{ asset('assets/img/brand23.png') }}">
        <img src="{{ asset('assets/img/brand24.png') }}">
        <img src="{{ asset('assets/img/brand25.png') }}">
        <img src="{{ asset('assets/img/brand26.jpeg') }}">
    </div>
        </div>
    </div>

    {{-- Law Partnership --}}
    <div class="partner-section">
        <div class="partner-title">{{ __('site.mitra.law') }}</div>
        <div class="partner-row">
        <img src="{{ asset('assets/img/law1.jpeg') }}">
        <img src="{{ asset('assets/img/law2.jpeg') }}">
    </div>
        </div>
    </div>

    {{-- International Promotion Trade Center Partnership --}}
    <div class="partner-section">
        <div class="partner-title">{{ __('site.mitra.ip_trade') }}</div>
        <div class="partner-row">
        <img src="{{ asset('assets/img/ip1.png') }}">
        <img src="{{ asset('assets/img/ip2.png') }}">
        <img src="{{ asset('assets/img/ip3.jpeg') }}">
        <img src="{{ asset('assets/img/ip4.jpeg') }}">
        <img src="{{ asset('assets/img/ip5.png') }}">
        <img src="{{ asset('assets/img/ip6.jpeg') }}">
        <img src="{{ asset('assets/img/ip7.jpeg') }}">
</div>
@include('layouts.footer')
