
@include('layouts.header')


<div class="container py-5" style="min-height: 70vh;">
    <h2 class="text-center fw-bold mb-5" style="font-size: 3rem; animation: fadeInDown 1s ease forwards; opacity: 0;">{{ __('site.visimisi.title') }}</h2>

    <div class="row justify-content-center g-4 d-flex align-items-stretch">

        <!-- Visi -->
        <div class="col-md-6 d-flex">
            <div class="kotak" style="background-color: #fff; border-radius: 10px; 
                        box-shadow: 0 4px 10px rgba(0,0,0,0.1); 
                        padding: 2rem; flex: 1; display: flex; flex-direction: column; justify-content: start; 
                        cursor: pointer; opacity: 0; animation: fadeInLeft 1s ease forwards;">
                <h3 class="fw-bold mb-3" style="font-size: 1.8rem;">{{ __('site.visimisi.visi_label') }}</h3>
                <p style="text-align: justify; font-size: 1.1rem; line-height: 1.6;">
                    {{ __('site.visimisi.visi_text') }}
                </p>
            </div>
        </div>

        <!-- Misi -->
        <div class="col-md-6 d-flex">
            <div class="kotak" style="background-color: #fff; border-radius: 10px; 
                        box-shadow: 0 4px 10px rgba(0,0,0,0.1); 
                        padding: 2rem; flex: 1; display: flex; flex-direction: column; justify-content: start; 
                        cursor: pointer; opacity: 0; animation: fadeInRight 1s ease forwards;">
                <h3 class="fw-bold mb-3" style="font-size: 1.8rem;">{{ __('site.visimisi.misi_label') }}</h3>
                <ul style="text-align: justify; font-size: 1.1rem; line-height: 1.6; padding-left: 1.2rem;">
                    <li>{{ __('site.visimisi.misi_1') }}</li>
                    <li>{{ __('site.visimisi.misi_2') }}</li>
                    <li>{{ __('site.visimisi.misi_3') }}</li>
                </ul>
            </div>
        </div>

    </div>
</div>


<style>
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