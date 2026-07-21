@include('layouts.header')

<style>
.partnership-wrapper {
    max-width: 1100px; /* LEBAR, TAPI TERKONTROL */
    margin: 110px auto;
    padding: 0 24px;
}

.partnership-card {
    background: #fff;
    border-radius: 18px;
    padding: 36px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    animation: fadeUp 0.6s ease forwards;
}

.partnership-title {
    text-align: center;
    font-size: 38px;
    font-weight: 700;
    margin-bottom: 10px;
}

.partnership-subtitle {
    text-align: center;
    color: #666;
    margin-bottom: 40px;
}

.form-control {
    border-radius: 12px;
    padding: 14px 16px;
}

.btn-submit {
    padding: 16px;
    border-radius: 14px;
    font-weight: 600;
    transition: 0.25s;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 28px rgba(13,110,253,0.35);
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.success-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    animation: fadeIn 0.3s ease;
}

.success-card {
    background: #fff;
    border-radius: 18px;
    padding: 36px 32px;
    text-align: center;
    width: 360px;
    animation: popUp 0.4s ease;
}

.success-card h4 {
    margin-top: 18px;
    font-weight: 700;
}

.success-card p {
    color: #666;
    font-size: 14px;
    margin-bottom: 20px;
}

.success-card button {
    background: #0d6efd;
    color: #fff;
    border: none;
    padding: 12px 20px;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
}

.checkmark svg {
    width: 72px;
    height: 72px;
    stroke: #0d6efd;
    stroke-width: 4;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.checkmark circle {
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    animation: drawCircle 0.6s ease forwards;
}

.checkmark path {
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    animation: drawCheck 0.4s ease forwards 0.5s;
}

@keyframes drawCircle {
    to { stroke-dashoffset: 0; }
}

@keyframes drawCheck {
    to { stroke-dashoffset: 0; }
}

@keyframes popUp {
    from { transform: scale(0.85); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

</style>

<div class="partnership-wrapper">
    <h2 class="partnership-title">{{ __('site.kerjasama.title') }}</h2>
    <p class="partnership-subtitle">
        {{ __('site.kerjasama.subtitle') }}
    </p>

    <form method="POST"
      action="{{ route('partnership.store') }}"
      enctype="multipart/form-data">
    @csrf

        <div class="partnership-card">
            <div class="row g-4">

                {{-- KIRI --}}
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ __('site.kerjasama.nama_institusi') }}</label>
                        <input type="text" name="institution_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ __('site.kerjasama.nama_pic') }}</label>
                        <input type="text" name="pic_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ __('site.kerjasama.email') }}</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>

                {{-- KANAN --}}
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ __('site.kerjasama.rangkuman') }}</label>
                        <textarea name="summary" rows="6" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ __('site.kerjasama.proposal') }}</label>
                        <input type="file" name="proposal_file" class="form-control">
                    </div>

                    <button class="btn btn-primary w-100 btn-submit mt-2">
                        {{ __('site.kerjasama.submit') }}
                    </button>
                </div>

            </div>
        </div>
    </form>
</div>
@if(session('success'))
<div class="success-overlay" id="successOverlay">
    <div class="success-card">
        <div class="checkmark">
            <svg viewBox="0 0 52 52">
                <circle cx="26" cy="26" r="25" fill="none"/>
                <path fill="none" d="M14 27l7 7 17-17"/>
            </svg>
        </div>
        <h4>{{ __('site.kerjasama.success_title') }}</h4>
        <p>{{ __('site.kerjasama.success_text') }}</p>
        <button onclick="closeSuccess()">{{ __('site.kerjasama.close') }}</button>
    </div>
</div>
@endif

<script>
function closeSuccess() {
    document.getElementById('successOverlay').remove();
}
</script>

@include('layouts.footer')
