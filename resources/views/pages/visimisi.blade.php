
@include('layouts.header')


<div class="container py-5" style="min-height: 70vh;">
    <h2 class="text-center fw-bold mb-5 visimisi-title" style="animation: fadeInDown 1s ease forwards; opacity: 0;">{{ __('site.visimisi.title') }}</h2>

    <div class="row justify-content-center g-4 d-flex align-items-stretch">

        <!-- Visi -->
        <div class="col-md-6 d-flex">
            <div class="kotak visimisi-box" style="cursor: pointer; opacity: 0; animation: fadeInLeft 1s ease forwards;">
                <h3 class="fw-bold mb-3 visimisi-heading">{{ __('site.visimisi.visi_label') }}</h3>
                <p class="visimisi-text">
                    {{ __('site.visimisi.visi_text') }}
                </p>
            </div>
        </div>

        <!-- Misi -->
        <div class="col-md-6 d-flex">
            <div class="kotak visimisi-box" style="cursor: pointer; opacity: 0; animation: fadeInRight 1s ease forwards;">
                <h3 class="fw-bold mb-3 visimisi-heading">{{ __('site.visimisi.misi_label') }}</h3>
                <ul class="visimisi-text" style="padding-left: 1.2rem;">
                    <li>{{ __('site.visimisi.misi_1') }}</li>
                    <li>{{ __('site.visimisi.misi_2') }}</li>
                    <li>{{ __('site.visimisi.misi_3') }}</li>
                </ul>
            </div>
        </div>

    </div>
</div>


<style>
.visimisi-title {
    font-size: clamp(1.8rem, 5vw, 3rem);
}

.visimisi-box {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    padding: 2rem;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: start;
}

.visimisi-heading {
    font-size: clamp(1.3rem, 3.5vw, 1.8rem);
}

.visimisi-text {
    text-align: justify;
    font-size: clamp(0.95rem, 2vw, 1.1rem);
    line-height: 1.6;
}

@media (max-width: 575.98px) {
    .visimisi-box {
        padding: 1.4rem;
    }

    .visimisi-text {
        text-align: left;
    }
}

/* Fade animations */
@keyframes fadeInLeft {
    0% { opacity: 0; transform: translateX(-50px); }
    100% { opacity: 1; transform: translateX(0); }
}

@keyframes fadeInRight {
    0% { opacity: 0; transform: translateX(50px); }
    100% { opacity: 1; transform: translateX(0); }
}

@keyframes fadeInDown {
    0% { opacity: 0; transform: translateY(-30px); }
    100% { opacity: 1; transform: translateY(0); }
}

/* Hover effect */
.kotak:hover {
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    transform: translateY(-5px);
    transition: transform 0.3s, box-shadow 0.3s;
}
</style>
@include('layouts.footer')