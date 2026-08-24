@php
    $title = __('site.keanggotaan.title') . ' — MVP.N';
    $metaDescription = __('site.keanggotaan.subtitle');
@endphp
@include('layouts.header')

<style>
.keang-hero {
    background: linear-gradient(155deg, var(--color-navy-700), var(--color-navy-900));
    color: #fff;
    padding: 72px 0 56px;
    text-align: center;
}

.keang-hero .section-eyebrow {
    background: rgba(255,255,255,0.1);
    color: var(--color-gold-500);
}

.keang-hero h1 {
    font-size: clamp(1.8rem, 4.5vw, 2.75rem);
    font-weight: 800;
    margin: 14px 0 10px;
}

.keang-hero p {
    color: rgba(255,255,255,0.75);
    max-width: 560px;
    margin: 0 auto;
    font-size: 1rem;
    line-height: 1.6;
}

.keang-section {
    background: #fff;
    padding: 56px 0 88px;
}

.keang-card {
    max-width: 760px;
    margin: -48px auto 0;
    background: #fff;
    border-radius: var(--radius-lg, 22px);
    box-shadow: var(--shadow-lg);
    padding: clamp(1.5rem, 4vw, 2.75rem);
    position: relative;
}

/* Stepper */
.keang-stepper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 36px;
    gap: 4px;
}

.keang-stepper-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    flex: 1;
    min-width: 0;
}

.keang-stepper-circle {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.85rem;
    background: var(--color-navy-50);
    color: var(--color-navy-300);
    border: 2px solid var(--color-navy-50);
    transition: background .3s var(--ease-material), color .3s, border-color .3s;
}

.keang-stepper-label {
    font-size: 0.68rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    color: var(--color-navy-300);
    text-align: center;
}

.keang-stepper-item.is-active .keang-stepper-circle {
    background: var(--color-primary-500);
    border-color: var(--color-primary-500);
    color: #fff;
}

.keang-stepper-item.is-active .keang-stepper-label {
    color: var(--color-primary-600);
}

.keang-stepper-item.is-done .keang-stepper-circle {
    background: var(--color-primary-50);
    border-color: var(--color-primary-500);
    color: var(--color-primary-500);
}

.keang-stepper-line {
    height: 2px;
    flex: 1;
    background: var(--color-navy-50);
    margin: 0 -4px;
    position: relative;
    top: -12px;
    max-width: 60px;
}

.keang-stepper-item.is-done + .keang-stepper-line,
.keang-stepper-item.is-active + .keang-stepper-line {
    background: var(--color-primary-300);
}

@media (max-width: 575.98px) {
    .keang-stepper-label { display: none; }
}

/* Wizard steps */
.wizard-step { display: none; }
.wizard-step.active { display: block; animation: fadeUp 0.35s ease; }

.wizard-step-title {
    font-size: 1.15rem;
    font-weight: 700;
    margin-bottom: 4px;
}

.wizard-step-hint {
    color: #777;
    font-size: 0.88rem;
    margin-bottom: 22px;
}

.keang-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0 16px;
}

@media (max-width: 575.98px) {
    .keang-row { grid-template-columns: 1fr; }
}

.keang-section .form-control,
.keang-section select.form-control {
    border-radius: 10px;
    padding: 13px 16px;
    background: #fff;
    border: 1.5px solid #e4e4e4;
    color: inherit;
    width: 100%;
    transition: border-color .2s, box-shadow .2s;
}

.keang-section .form-control::placeholder { color: #999; }

.keang-section .form-control:focus {
    border-color: var(--color-primary-500);
    box-shadow: 0 0 0 4px var(--color-primary-50);
}

.keang-section .invalid-feedback { color: var(--color-primary-600); font-size: 0.8rem; margin-top: 4px; }
.keang-section .is-invalid { border-color: var(--color-primary-500) !important; }
.keang-section .text-muted { color: #888 !important; font-size: 0.8rem; }

.keang-field { margin-bottom: 18px; }
.keang-field label {
    display: block;
    font-size: 0.85rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 6px;
}
.keang-field textarea.form-control { min-height: 100px; resize: none; }

/* Bidang minat checkboxes */
.keang-interest-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}

@media (max-width: 575.98px) {
    .keang-interest-grid { grid-template-columns: 1fr; }
}

.keang-interest-pill {
    display: flex;
    align-items: center;
    gap: 10px;
    border: 1.5px solid #e4e4e4;
    border-radius: 10px;
    padding: 12px 14px;
    cursor: pointer;
    font-size: 0.88rem;
    transition: border-color .2s, background .2s, opacity .2s;
}

.keang-interest-pill input { accent-color: var(--color-primary-500); }
.keang-interest-pill:has(input:checked) { border-color: var(--color-primary-500); background: var(--color-primary-50); }
.keang-interest-pill:has(input:disabled:not(:checked)) { opacity: 0.45; cursor: not-allowed; }

.keang-interest-hint {
    margin-top: 12px;
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--color-navy-300);
}

/* Komitmen */
.keang-statement {
    background: var(--color-navy-50);
    border-radius: 12px;
    padding: 18px 20px;
    font-size: 0.9rem;
    line-height: 1.65;
    color: var(--color-navy-500);
    margin-bottom: 20px;
}

.keang-check {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 0.88rem;
    margin-bottom: 12px;
    cursor: pointer;
}

.keang-check input { margin-top: 3px; accent-color: var(--color-primary-500); flex-shrink: 0; }

/* Nav buttons */
.keang-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 28px;
    gap: 12px;
}

.keang-btn-back {
    background: none;
    border: 1.5px solid #e4e4e4;
    border-radius: 10px;
    padding: 13px 22px;
    font-weight: 600;
    color: #555;
    transition: border-color .2s, color .2s;
}

.keang-btn-back:hover { border-color: var(--color-navy-300); color: var(--color-navy-500); }

.keang-btn-next,
.keang-btn-submit {
    margin-left: auto;
    padding: 14px 26px;
    border-radius: 10px;
    border: none;
    background: var(--color-primary-500);
    color: #fff;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background .2s, box-shadow .2s, transform .2s;
}

.keang-btn-next:hover,
.keang-btn-submit:hover {
    background: var(--color-primary-600);
    box-shadow: 0 12px 28px rgba(206,17,38,0.28);
    color: #fff;
}

.keang-btn-submit:disabled { cursor: not-allowed; opacity: 0.85; }

.keang-btn-submit-spinner {
    display: none;
    width: 16px;
    height: 16px;
    border: 2.5px solid rgba(255,255,255,0.4);
    border-top-color: #fff;
    border-radius: 50%;
    animation: spin 0.7s linear infinite;
}

.keang-btn-submit.is-loading .keang-btn-submit-spinner { display: inline-block; }

@keyframes spin { to { transform: rotate(360deg); } }
@keyframes fadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }

.hp-field { position: absolute; left: -9999px; top: -9999px; width: 1px; height: 1px; overflow: hidden; }

/* Success / error — same pattern as #kerjasama */
.success-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.45); display: flex; align-items: center; justify-content: center; z-index: 9999; animation: fadeInOverlay 0.3s ease; }
.success-card { background: #fff; border-radius: var(--radius-lg, 22px); padding: 36px 32px 28px; text-align: center; width: 360px; max-width: 90vw; animation: popUp 0.4s ease; position: relative; overflow: hidden; }
@media (max-width: 575.98px) { .success-overlay { padding: 16px; } .success-card { width: 100%; padding: 28px 20px 22px; } }
.success-card-progress { position: relative; margin-top: 18px; height: 3px; border-radius: 999px; background: var(--color-primary-50); overflow: hidden; }
.success-card-progress span { display: block; width: 0%; height: 100%; background: var(--color-primary-500); transition: width linear; }
.success-card h4 { margin-top: 18px; font-weight: 700; }
.success-card p { color: #666; font-size: 14px; margin-bottom: 20px; }
.success-card button { background: var(--color-primary-500); color: #fff; border: none; padding: 12px 20px; border-radius: 12px; font-weight: 600; cursor: pointer; }
.checkmark svg { width: 72px; height: 72px; stroke: var(--color-success); stroke-width: 4; stroke-linecap: round; stroke-linejoin: round; }
.checkmark circle { stroke-dasharray: 166; stroke-dashoffset: 166; animation: drawCircle 0.6s ease forwards; }
.checkmark path { stroke-dasharray: 48; stroke-dashoffset: 48; animation: drawCheck 0.4s ease forwards 0.5s; }
@keyframes drawCircle { to { stroke-dashoffset: 0; } }
@keyframes drawCheck { to { stroke-dashoffset: 0; } }
@keyframes popUp { from { transform: scale(0.85); opacity: 0; } to { transform: scale(1); opacity: 1; } }
@keyframes fadeInOverlay { from { opacity: 0; } to { opacity: 1; } }

.error-toast { position: relative; background: #fff8f8; border-left: 4px solid var(--color-primary-500); border-radius: 12px; padding: 16px 44px 16px 16px; margin-bottom: 24px; display: flex; align-items: flex-start; gap: 12px; animation: toastIn 0.4s cubic-bezier(.22,.9,.3,1) forwards; }
.error-toast.error-toast-hide { animation: toastOut 0.35s ease forwards; }
.error-toast-icon { flex-shrink: 0; width: 30px; height: 30px; border-radius: 50%; background: var(--color-primary-50); color: var(--color-primary-600); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 16px; }
.error-toast-body h6 { font-weight: 700; margin-bottom: 4px; font-size: 14px; }
.error-toast-body p { margin: 0; font-size: 13px; color: #666; line-height: 1.4; }
.error-toast-close { position: absolute; top: 10px; right: 12px; border: none; background: none; color: #999; font-size: 18px; line-height: 1; cursor: pointer; padding: 4px; }
.error-toast-close:hover { color: #333; }
@keyframes toastIn { from { opacity: 0; transform: translateY(-16px) scale(.97); } to { opacity: 1; transform: translateY(0) scale(1); } }
@keyframes toastOut { from { opacity: 1; transform: translateY(0) scale(1); } to { opacity: 0; transform: translateY(-16px) scale(.97); } }
</style>

<section class="keang-hero">
    <div class="container">
        <span class="section-eyebrow">{{ __('site.nav.keanggotaan') }}</span>
        <h1>{{ __('site.keanggotaan.title') }}</h1>
        <p>{{ __('site.keanggotaan.subtitle') }}</p>
    </div>
</section>

<section class="keang-section">
    <div class="container">
        <div class="keang-card">

            @if ($errors->any())
                <div class="error-toast" id="errorToast">
                    <div class="error-toast-icon">!</div>
                    <div class="error-toast-body">
                        @if ($errors->has('photo'))
                            <h6>{{ __('site.keanggotaan.toast_upload_title') }}</h6>
                            <p>{{ $errors->first('photo') }}</p>
                        @else
                            <h6>{{ __('site.keanggotaan.toast_error_title') }}</h6>
                            <p>{{ $errors->first() }}</p>
                        @endif
                    </div>
                    <button type="button" class="error-toast-close" onclick="closeErrorToast()" aria-label="Close">&times;</button>
                </div>
            @endif

            <div class="keang-stepper" id="keangStepper">
                @foreach([1,2,3,4,5] as $s)
                    <div class="keang-stepper-item" data-step-indicator="{{ $s }}">
                        <div class="keang-stepper-circle">{{ $s }}</div>
                        <div class="keang-stepper-label">{{ __('site.keanggotaan.step_' . $s) }}</div>
                    </div>
                    @if($s < 5)<div class="keang-stepper-line"></div>@endif
                @endforeach
            </div>

            <form method="POST" action="{{ route('keanggotaan.store') }}" enctype="multipart/form-data" id="keangForm">
                @csrf

                <div class="hp-field" aria-hidden="true">
                    <label for="website">Website</label>
                    <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                </div>

                {{-- STEP 1 — Data Diri --}}
                <div class="wizard-step active" data-step="1">
                    <h3 class="wizard-step-title">{{ __('site.keanggotaan.step_1') }}</h3>

                    <div class="keang-row">
                        <div class="keang-field">
                            <label>{{ __('site.keanggotaan.full_name') }}</label>
                            <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control @error('full_name') is-invalid @enderror" maxlength="150" required>
                            @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="keang-field">
                            <label>{{ __('site.keanggotaan.nickname') }}</label>
                            <input type="text" name="nickname" value="{{ old('nickname') }}" class="form-control @error('nickname') is-invalid @enderror" maxlength="50">
                            @error('nickname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="keang-row">
                        <div class="keang-field">
                            <label>{{ __('site.keanggotaan.nik') }}</label>
                            <input type="text" inputmode="numeric" name="nik" value="{{ old('nik') }}" class="form-control @error('nik') is-invalid @enderror" maxlength="16" pattern="\d{16}" required>
                            @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="keang-field">
                            <label>{{ __('site.keanggotaan.gender') }}</label>
                            <select name="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>{{ __('site.keanggotaan.gender_select') }}</option>
                                <option value="male" @selected(old('gender') === 'male')>{{ __('site.keanggotaan.gender_male') }}</option>
                                <option value="female" @selected(old('gender') === 'female')>{{ __('site.keanggotaan.gender_female') }}</option>
                            </select>
                            @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="keang-row">
                        <div class="keang-field">
                            <label>{{ __('site.keanggotaan.birth_place') }}</label>
                            <input type="text" name="birth_place" value="{{ old('birth_place') }}" class="form-control @error('birth_place') is-invalid @enderror" maxlength="100" required>
                            @error('birth_place')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="keang-field">
                            <label>{{ __('site.keanggotaan.birth_date') }}</label>
                            <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="form-control @error('birth_date') is-invalid @enderror" max="{{ now()->subDay()->toDateString() }}" required>
                            @error('birth_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="keang-row">
                        <div class="keang-field">
                            <label>{{ __('site.keanggotaan.whatsapp') }}</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" class="form-control @error('whatsapp') is-invalid @enderror" maxlength="20" required>
                            @error('whatsapp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="keang-field">
                            <label>{{ __('site.keanggotaan.email') }}</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" maxlength="150" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="keang-field">
                        <label>{{ __('site.keanggotaan.address') }}</label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" maxlength="500" required>{{ old('address') }}</textarea>
                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="keang-row">
                        <div class="keang-field">
                            <label>{{ __('site.keanggotaan.province') }}</label>
                            <input type="text" name="province" value="{{ old('province') }}" class="form-control @error('province') is-invalid @enderror" maxlength="100" required>
                            @error('province')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="keang-field">
                            <label>{{ __('site.keanggotaan.city') }}</label>
                            <input type="text" name="city" value="{{ old('city') }}" class="form-control @error('city') is-invalid @enderror" maxlength="100" required>
                            @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="keang-row">
                        <div class="keang-field">
                            <label>{{ __('site.keanggotaan.social_media') }}</label>
                            <input type="text" name="social_media" value="{{ old('social_media') }}" class="form-control @error('social_media') is-invalid @enderror" maxlength="150">
                            @error('social_media')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="keang-field">
                            <label>{{ __('site.keanggotaan.photo') }}</label>
                            <input type="file" name="photo" accept=".jpg,.jpeg,.png" class="form-control @error('photo') is-invalid @enderror" required>
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small class="text-muted">{{ __('site.keanggotaan.photo_hint') }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- STEP 2 — Latar Belakang --}}
                <div class="wizard-step" data-step="2">
                    <h3 class="wizard-step-title">{{ __('site.keanggotaan.step_2') }}</h3>

                    <div class="keang-row">
                        <div class="keang-field">
                            <label>{{ __('site.keanggotaan.last_education') }}</label>
                            <select name="last_education" class="form-control @error('last_education') is-invalid @enderror" required>
                                <option value="" disabled {{ old('last_education') ? '' : 'selected' }}>{{ __('site.keanggotaan.last_education_select') }}</option>
                                @foreach(['sd','smp','sma','d3','d4_s1','s2','s3'] as $eduKey)
                                    <option value="{{ $eduKey }}" @selected(old('last_education') === $eduKey)>{{ __('site.keanggotaan.edu_' . $eduKey) }}</option>
                                @endforeach
                            </select>
                            @error('last_education')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="keang-field">
                            <label>{{ __('site.keanggotaan.education_institution') }}</label>
                            <input type="text" name="education_institution" value="{{ old('education_institution') }}" class="form-control @error('education_institution') is-invalid @enderror" maxlength="150">
                            @error('education_institution')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="keang-row">
                        <div class="keang-field">
                            <label>{{ __('site.keanggotaan.occupation') }}</label>
                            <input type="text" name="occupation" value="{{ old('occupation') }}" class="form-control @error('occupation') is-invalid @enderror" maxlength="150">
                            @error('occupation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="keang-field">
                            <label>{{ __('site.keanggotaan.company') }}</label>
                            <input type="text" name="company" value="{{ old('company') }}" class="form-control @error('company') is-invalid @enderror" maxlength="150">
                            @error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="keang-field">
                        <label>{{ __('site.keanggotaan.expertise') }}</label>
                        <input type="text" name="expertise" value="{{ old('expertise') }}" class="form-control @error('expertise') is-invalid @enderror" maxlength="150">
                        @error('expertise')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="keang-field">
                        <label>{{ __('site.keanggotaan.organizations') }}</label>
                        <textarea name="organizations" class="form-control @error('organizations') is-invalid @enderror" maxlength="1000">{{ old('organizations') }}</textarea>
                        @error('organizations')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="keang-field">
                        <label>{{ __('site.keanggotaan.leadership_experience') }}</label>
                        <textarea name="leadership_experience" class="form-control @error('leadership_experience') is-invalid @enderror" maxlength="1000">{{ old('leadership_experience') }}</textarea>
                        @error('leadership_experience')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="keang-field">
                        <label>{{ __('site.keanggotaan.social_experience') }}</label>
                        <textarea name="social_experience" class="form-control @error('social_experience') is-invalid @enderror" maxlength="1000">{{ old('social_experience') }}</textarea>
                        @error('social_experience')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="keang-field">
                        <label>{{ __('site.keanggotaan.international_experience') }}</label>
                        <textarea name="international_experience" class="form-control @error('international_experience') is-invalid @enderror" maxlength="1000">{{ old('international_experience') }}</textarea>
                        @error('international_experience')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- STEP 3 — Motivasi --}}
                <div class="wizard-step" data-step="3">
                    <h3 class="wizard-step-title">{{ __('site.keanggotaan.step_3') }}</h3>

                    @foreach(['motivation_reason','mvpn_knowledge','contribution','interest_issue','vision_youth'] as $q)
                        <div class="keang-field">
                            <label>{{ __('site.keanggotaan.' . $q) }}</label>
                            <textarea name="{{ $q }}" class="form-control @error($q) is-invalid @enderror" maxlength="2000" required>{{ old($q) }}</textarea>
                            @error($q)<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    @endforeach
                </div>

                {{-- STEP 4 — Bidang Minat --}}
                <div class="wizard-step" data-step="4">
                    <h3 class="wizard-step-title">{{ __('site.keanggotaan.step_4') }}</h3>
                    <p class="wizard-step-hint">{{ __('site.keanggotaan.bidang_minat_title') }}</p>

                    <div class="keang-interest-grid" id="interestGrid">
                        @php $oldInterests = old('interest_fields', []); @endphp
                        @foreach(\App\Models\Membership::INTEREST_FIELDS as $key => $label)
                            <label class="keang-interest-pill">
                                <input type="checkbox" name="interest_fields[]" value="{{ $key }}" @checked(in_array($key, $oldInterests))>
                                {{ __('site.keanggotaan.interests.' . $key) }}
                            </label>
                        @endforeach
                    </div>
                    <div class="keang-interest-hint" id="interestHint"></div>
                    @error('interest_fields')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- STEP 5 — Komitmen --}}
                <div class="wizard-step" data-step="5">
                    <h3 class="wizard-step-title">{{ __('site.keanggotaan.step_5') }}</h3>

                    <div class="keang-statement">{{ __('site.keanggotaan.commitment_statement') }}</div>

                    <label class="keang-check">
                        <input type="checkbox" name="agree_statement" value="1" @checked(old('agree_statement')) required>
                        {{ __('site.keanggotaan.agree_statement') }}
                    </label>
                    <label class="keang-check">
                        <input type="checkbox" name="agree_code_of_conduct" value="1" @checked(old('agree_code_of_conduct')) required>
                        {{ __('site.keanggotaan.agree_code_of_conduct') }}
                    </label>
                    <label class="keang-check">
                        <input type="checkbox" name="agree_participate" value="1" @checked(old('agree_participate')) required>
                        {{ __('site.keanggotaan.agree_participate') }}
                    </label>
                    <label class="keang-check">
                        <input type="checkbox" name="agree_data_true" value="1" @checked(old('agree_data_true')) required>
                        {{ __('site.keanggotaan.agree_data_true') }}
                    </label>
                </div>

                <div class="keang-nav">
                    <button type="button" class="keang-btn-back" id="keangBackBtn" style="display:none;">{{ __('site.keanggotaan.btn_back') }}</button>
                    <button type="button" class="keang-btn-next" id="keangNextBtn">
                        {{ __('site.keanggotaan.btn_next') }}
                        <i class="bi bi-arrow-right"></i>
                    </button>
                    <button type="submit" class="keang-btn-submit" id="keangSubmitBtn" style="display:none;">
                        <span>{{ __('site.keanggotaan.submit') }}</span>
                        <span class="keang-btn-submit-spinner" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@if(session('success'))
<div class="success-overlay" id="successOverlay">
    <div class="success-card">
        <div class="checkmark">
            <svg viewBox="0 0 52 52">
                <circle cx="26" cy="26" r="25" fill="none"/>
                <path fill="none" d="M14 27l7 7 17-17"/>
            </svg>
        </div>
        <h4>{{ __('site.keanggotaan.success_title') }}</h4>
        <p>{{ __('site.keanggotaan.success_text') }}</p>
        <button onclick="closeSuccess()">{{ __('site.keanggotaan.close') }}</button>
        <div class="success-card-progress"><span id="successProgressBar"></span></div>
    </div>
</div>
@endif

<script>
function closeSuccess() {
    var el = document.getElementById('successOverlay');
    if (el) el.remove();
}

function closeErrorToast() {
    var toast = document.getElementById('errorToast');
    if (!toast) return;
    toast.classList.add('error-toast-hide');
    setTimeout(function () { toast.remove(); }, 350);
}

(function () {
    var toast = document.getElementById('errorToast');
    if (!toast) return;
    setTimeout(closeErrorToast, 6000);
})();

(function () {
    var bar = document.getElementById('successProgressBar');
    if (!bar) return;
    var duration = 8000;
    requestAnimationFrame(function () {
        bar.style.transitionDuration = duration + 'ms';
        bar.style.width = '100%';
    });
    setTimeout(closeSuccess, duration);
})();

(function () {
    var form = document.getElementById('keangForm');
    var steps = Array.prototype.slice.call(form.querySelectorAll('.wizard-step'));
    var stepperItems = Array.prototype.slice.call(document.querySelectorAll('.keang-stepper-item'));
    var backBtn = document.getElementById('keangBackBtn');
    var nextBtn = document.getElementById('keangNextBtn');
    var submitBtn = document.getElementById('keangSubmitBtn');
    var total = steps.length;
    var current = 1;

    function render() {
        steps.forEach(function (panel) {
            panel.classList.toggle('active', Number(panel.dataset.step) === current);
        });
        stepperItems.forEach(function (item) {
            var n = Number(item.dataset.stepIndicator);
            item.classList.toggle('is-active', n === current);
            item.classList.toggle('is-done', n < current);
        });
        backBtn.style.display = current === 1 ? 'none' : 'inline-flex';
        nextBtn.style.display = current === total ? 'none' : 'inline-flex';
        submitBtn.style.display = current === total ? 'inline-flex' : 'none';
    }

    function currentPanel() {
        return steps[current - 1];
    }

    function goTo(step) {
        current = Math.min(Math.max(step, 1), total);
        render();
        form.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    nextBtn.addEventListener('click', function () {
        var panel = currentPanel();
        var inputs = panel.querySelectorAll('input, select, textarea');
        for (var i = 0; i < inputs.length; i++) {
            if (!inputs[i].reportValidity()) return;
        }
        goTo(current + 1);
    });

    backBtn.addEventListener('click', function () {
        goTo(current - 1);
    });

    // Jump to the step containing the first server-side validation error.
    var errorToast = document.getElementById('errorToast');
    if (errorToast) {
        var invalidField = form.querySelector('.is-invalid');
        if (invalidField) {
            var panel = invalidField.closest('.wizard-step');
            if (panel) current = Number(panel.dataset.step);
        }
    }

    render();
})();

(function () {
    var grid = document.getElementById('interestGrid');
    var hint = document.getElementById('interestHint');
    if (!grid || !hint) return;
    var max = 3;

    function update() {
        var checkboxes = Array.prototype.slice.call(grid.querySelectorAll('input[type="checkbox"]'));
        var checkedCount = checkboxes.filter(function (c) { return c.checked; }).length;
        checkboxes.forEach(function (c) {
            c.disabled = !c.checked && checkedCount >= max;
        });
        hint.textContent = '{{ __('site.keanggotaan.bidang_minat_hint', ['count' => ':count']) }}'.replace(':count', checkedCount);
    }

    grid.addEventListener('change', update);
    update();
})();

(function () {
    var form = document.getElementById('keangForm');
    var btn = document.getElementById('keangSubmitBtn');
    form.addEventListener('submit', function () {
        if (!form.checkValidity()) return;
        btn.classList.add('is-loading');
        btn.disabled = true;
    });
})();
</script>

@include('layouts.footer')
