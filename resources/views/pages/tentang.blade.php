@include('layouts.header')

<style>
.tentang-title {
    font-size: clamp(1.8rem, 5vw, 3rem);
    font-weight: bold;
    color: #333;
}

.tentang-text {
    font-size: clamp(1rem, 2.2vw, 1.2rem);
    color: #555;
    line-height: 1.6;
    text-align: justify;
}

@media (max-width: 767.98px) {
    .tentang-text {
        text-align: left;
    }
}

.tentang-logo {
    max-width: 100%;
    height: auto;
    width: 550px;
}

@media (max-width: 575.98px) {
    .tentang-logo {
        width: 260px;
    }
}

@keyframes fadeInLeft {
    0% { opacity: 0; transform: translateX(-50px); }
    100% { opacity: 1; transform: translateX(0); }
}

@keyframes fadeInUp {
    0% { opacity: 0; transform: translateY(50px); }
    100% { opacity: 1; transform: translateY(0); }
}
</style>

<section class="py-5">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-7" style="animation: fadeInLeft 1.5s ease forwards; opacity: 0;">
                <h1 class="tentang-title mb-4">{{ __('site.tentang.title') }}</h1>
                <p class="tentang-text">{{ __('site.tentang.p1') }}</p>
                <p class="tentang-text">{{ __('site.tentang.p2') }}</p>
                <p class="tentang-text">{{ __('site.tentang.p3') }}</p>
            </div>

            <div class="col-md-5 text-center"
                 style="animation: fadeInUp 1.5s ease forwards; opacity: 0;">
                <img src="{{ asset('assets/img/mvpn.png') }}"
                     alt="Logo"
                     class="tentang-logo">
            </div>

        </div>
    </div>
</section>

@include('layouts.footer')
