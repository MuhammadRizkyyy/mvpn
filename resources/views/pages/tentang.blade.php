@include('layouts.header')

<section class="py-5"></section>
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-7" style="text-align: justify; 
                        animation: fadeInLeft 1.5s ease forwards; 
                        opacity: 0;">
                <h1 style="font-size: 3rem; font-weight: bold; color: #333;" class="mb-4">{{ __('site.tentang.title') }}</h1>
                <p style="font-size: 1.2rem; color: #555; line-height: 1.6;">
                    {{ __('site.tentang.p1') }}
                <p style="font-size: 1.2rem; color: #555; line-height: 1.6;">
                    {{ __('site.tentang.p2') }}
                <p style="font-size: 1.2rem; color: #555; line-height: 1.6;">
                    {{ __('site.tentang.p3') }}
                </p>
            </div>

            
            <div class="col-md-5 text-center" 
                 style="animation: fadeInUp 1.5s ease forwards; opacity: 0;">
                <img src="{{ asset('assets/img/mvpn.png') }}" 
                     alt="Logo" 
                     style="max-width: 100%; height: auto; width: 550px;">
            </div>

        </div>
    </div>
</section>


<style>
@keyframes fadeInLeft {
    0% { opacity: 0; transform: translateX(-50px); }
    100% { opacity: 1; transform: translateX(0); }
}

@keyframes fadeInUp {
    0% { opacity: 0; transform: translateY(50px); }
    100% { opacity: 1; transform: translateY(0); }
}
</style>

@include('layouts.footer')
