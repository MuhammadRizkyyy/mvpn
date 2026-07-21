@include('layouts.header')

<style>
.struktur-page {
    margin-top: 100px;
}

.struktur-wrapper {
    max-width: 920px;
    margin: 0 auto;
}

@media (max-width: 575.98px) {
    .struktur-page {
        margin-top: 70px;
    }

    .accordion-button {
        padding: 14px 16px;
        font-size: 0.95rem;
    }

    .member-photo {
        height: 220px;
    }

    .member-info {
        padding: 14px;
    }
}

.accordion-item {
    border: none;
    margin-bottom: 16px;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
}

.accordion-button {
    font-weight: 700;
    padding: 18px 24px;
    background: #fff;
    transition: 0.3s;
}

.accordion-button:not(.collapsed) {
    background: #f8f9fa;
    color: #000;
}

.accordion-body {
    animation: fadeSlide 0.6s ease;
}

/* ===== CARD ===== */
.member-card {
    background: #fff;
    border-radius: 14px;
    overflow: hidden;
    transition: 0.35s ease;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
}

.member-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.15);
}

.member-photo {
    width: 100%;
    height: 280px;
    object-fit: contain;
    object-position: center top;
    background: #f2f2f2;
}

.member-info {
    padding: 18px;
    text-align: center;
}

.member-info h5 {
    font-weight: 700;
    margin-bottom: 4px;
}

.member-info p {
    color: #777;
    margin-bottom: 10px;
}

.ig-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: linear-gradient(45deg, #feda75, #d62976, #4f5bd5);
    color: #fff;
    font-size: 1.1rem;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.ig-btn:hover {
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 6px 14px rgba(214,41,118,0.35);
}

@keyframes fadeSlide {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<div class="container py-5 struktur-page">
    <h2 class="text-center fw-bold mb-5">{{ __('site.struktur.title') }}</h2>

    <div class="struktur-wrapper">
        <div class="accordion" id="strukturAccordion">

            {{-- BOD --}}
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#bod">
                        {{ __('site.struktur.bod') }}
                    </button>
                </h2>
                <div id="bod" class="accordion-collapse collapse show" data-bs-parent="#strukturAccordion">
                    <div class="accordion-body">
                        <div class="row justify-content-center g-4">
                            <div class="col-12 col-sm-8 col-md-5">
                                <div class="member-card">
                                    <img class="member-photo" src="{{ asset('assets/img/pres1.png') }}">
                                    <div class="member-info">
                                        <h5>Indra A. Oktariawan</h5>
                                        <p>{{ __('site.struktur.president') }}</p>
                                        <a href="https://www.instagram.com/oktariawanindra?igsh=MWNkZG1kZGE1NHZrZg==" class="ig-btn" title="{{ __('site.struktur.instagram') }}"><i class="bi bi-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-8 col-md-5">
                                <div class="member-card">
                                    <img class="member-photo" src="{{ asset('assets/img/wapres.png') }}">
                                    <div class="member-info">
                                        <h5>Ani Yuliani</h5>
                                        <p>{{ __('site.struktur.vice_president') }}</p>
                                        <a href="https://www.instagram.com/aniyuliani2020?igsh=MWRwMWR4emJqY3E0aQ==
" class="ig-btn" title="{{ __('site.struktur.instagram') }}"><i class="bi bi-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SEKRETARIS --}}
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sekretaris">
                        {{ __('site.struktur.sekretaris_section') }}
                    </button>
                </h2>
                <div id="sekretaris" class="accordion-collapse collapse" data-bs-parent="#strukturAccordion">
                    <div class="accordion-body">
                        <div class="row justify-content-center g-4">
                            <div class="col-12 col-sm-8 col-md-5">
                                <div class="member-card">
                                    <img class="member-photo" src="{{ asset('assets/img/sekre1.png') }}">
                                    <div class="member-info">
                                        <h5>Putri Wardhany</h5>
                                        <p>{{ __('site.struktur.sekretaris') }}</p>
                                        <a href="https://www.instagram.com/__putriwardha?igsh=MXh6NThjZWxha3BhaA==" class="ig-btn" title="{{ __('site.struktur.instagram') }}"><i class="bi bi-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-8 col-md-5">
                                <div class="member-card">
                                    <img class="member-photo" src="{{ asset('assets/img/sekre2_v2.png') }}">
                                    <div class="member-info">
                                        <h5>Maria C. Maharani</h5>
                                        <p>{{ __('site.struktur.wakil_sekretaris') }}</p>
                                        <a href="https://www.instagram.com/raanisti?igsh=MWEyMmN0N3JuOXY0Zg==
" class="ig-btn" title="{{ __('site.struktur.instagram') }}"><i class="bi bi-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- EKONOMI --}}
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#ekonomi">
                        {{ __('site.struktur.ekonomi_section') }}
                    </button>
                </h2>
                <div id="ekonomi" class="accordion-collapse collapse" data-bs-parent="#strukturAccordion">
                    <div class="accordion-body">
                        <div class="row justify-content-center g-4">
                            <div class="col-12 col-sm-8 col-md-5">
                                <div class="member-card">
                                    <img class="member-photo" src="{{ asset('assets/img/direktorat.png') }}">
                                    <div class="member-info">
                                        <h5>Susanty</h5>
                                        <p>{{ __('site.struktur.direktorat') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-8 col-md-5">
                                <div class="member-card">
                                    <img class="member-photo" src="{{ asset('assets/img/wakildirektorat.png') }}">
                                    <div class="member-info">
                                        <h5>Ajeng Fimara</h5>
                                        <p>{{ __('site.struktur.wakil_direktorat') }}</p>
                                        <a href="https://www.instagram.com/ajengfsbtr_?igsh=Y3oxaThqZWJ3dnJ1
" class="ig-btn" title="{{ __('site.struktur.instagram') }}"><i class="bi bi-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- INTERNASIONAL --}}
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#internasional">
                        {{ __('site.struktur.internasional_section') }}
                    </button>
                </h2>
                <div id="internasional" class="accordion-collapse collapse" data-bs-parent="#strukturAccordion">
                    <div class="accordion-body">
                        <div class="row justify-content-center g-4">
                            <div class="col-12 col-sm-8 col-md-5">
                                <div class="member-card">
                                    <img class="member-photo" src="{{ asset('assets/img/hi asean.jpeg') }}">
                                    <div class="member-info">
                                        <h5>DR.(C). Ramdani Murdiana</h5>
                                        <p>{{ __('site.struktur.hi_asean') }}</p>
                                        <a href="https://www.instagram.com/walikutay?igsh=dDB0YTNvd3A3cWJh
" class="ig-btn" title="{{ __('site.struktur.instagram') }}"><i class="bi bi-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-8 col-md-5">
                                <div class="member-card">
                                    <img class="member-photo" src="{{ asset('assets/img/hi tim.png') }}">
                                    <div class="member-info">
                                        <h5>Budi Suranto</h5>
                                        <p>{{ __('site.struktur.hi_timteng') }}</p>
                                        <a href="#" class="ig-btn" title="{{ __('site.struktur.instagram') }}"><i class="bi bi-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- IT DEVELOPMENT --}}
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#itdev">
                        {{ __('site.struktur.itdev_section') }}
                    </button>
                </h2>
                <div id="itdev" class="accordion-collapse collapse" data-bs-parent="#strukturAccordion">
                    <div class="accordion-body">
                        <div class="row justify-content-center g-4">
                            <div class="col-12 col-sm-8 col-md-5">
                                <div class="member-card">
                                    <img class="member-photo" src="{{ asset('assets/img/it.jpeg') }}">
                                    <div class="member-info">
                                        <h5>Fardin Muhammad Azis</h5>
                                        <p>{{ __('site.struktur.frontend_dev') }}</p>
                                        <a href="https://www.instagram.com/swsevrydy_/" class="ig-btn" title="{{ __('site.struktur.instagram') }}"><i class="bi bi-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>

@include('layouts.footer')
