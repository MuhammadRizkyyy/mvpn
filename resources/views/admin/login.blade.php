<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login — MVP.N</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white font-sans lg:flex">

<a href="{{ url('/') }}" class="absolute left-6 top-6 z-10 flex items-center gap-2">
    <img src="{{ asset('assets/img/mvpn.png') }}" alt="Logo MVP.N" class="h-8 w-8 object-contain">
    <span class="font-display text-base font-semibold text-neutral-950">MVP.N</span>
</a>

{{-- ILLUSTRATION PANEL --}}
<div class="relative hidden overflow-hidden bg-navy-50 lg:flex lg:w-1/2 lg:items-center lg:justify-center">
    <span class="absolute left-[12%] top-[18%] h-3 w-3 rotate-12 rounded-sm bg-gold-500/70"></span>
    <span class="absolute left-[22%] top-[68%] h-2.5 w-2.5 rounded-full bg-primary-500/60"></span>
    <span class="absolute right-[16%] top-[24%] h-0 w-0 border-x-8 border-b-[14px] border-x-transparent border-b-primary-500/50"></span>
    <span class="absolute right-[24%] bottom-[20%] h-3 w-3 rotate-45 rounded-sm bg-navy-300/60"></span>
    <span class="absolute left-[30%] bottom-[14%] h-0 w-0 border-x-8 border-b-[14px] border-x-transparent border-b-gold-500/60"></span>
    <span class="absolute right-[14%] bottom-[38%] h-2 w-2 rounded-full bg-gold-500/70"></span>

    <div class="relative flex flex-col items-center text-center">
        <div class="absolute inset-0 -m-16 rounded-full border border-dashed border-navy-300/40"></div>
        <div class="relative flex h-40 w-40 items-center justify-center rounded-full bg-white shadow-lg">
            <img src="{{ asset('assets/img/mvpn.png') }}" alt="Logo MVP.N" class="h-24 w-24 object-contain">
        </div>
        <p class="mt-8 max-w-xs font-display text-lg font-semibold text-navy-900">Terbang Tinggi &amp; Sentuh Langit</p>
        <p class="mt-2 max-w-xs text-sm text-navy-300">Panel operator untuk mengelola konten Muda Visioner Penggerak Nasional.</p>
    </div>
</div>

{{-- FORM PANEL --}}
<div class="flex flex-1 items-center justify-center px-6 py-24 lg:w-1/2">
    <div class="w-full max-w-sm">
        <h1 class="font-display text-2xl font-bold text-neutral-950">Selamat Datang <span aria-hidden="true">👋</span></h1>
        <p class="mt-1 text-sm text-neutral-500">Masuk ke akun operator untuk mengelola konten.</p>

        @if(session('error'))
            <div class="mt-5 flex items-center gap-2 rounded-lg border border-primary-300/40 bg-primary-50 px-3.5 py-2.5 text-sm font-medium text-primary-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/admin/login" class="mt-6 space-y-5">
            @csrf

            <div>
                <label for="username" class="mb-1.5 block text-sm font-medium text-neutral-700">Username</label>
                <input type="text" name="username" id="username" required autofocus
                       class="block w-full rounded-lg border-neutral-300 text-sm focus:border-navy-500 focus:ring-navy-500">
            </div>

            <div>
                <label for="password" class="mb-1.5 block text-sm font-medium text-neutral-700">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" required
                           class="block w-full rounded-lg border-neutral-300 pr-10 text-sm focus:border-navy-500 focus:ring-navy-500">
                    <button type="button" onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 flex w-10 items-center justify-center text-neutral-400 hover:text-neutral-600"
                            aria-label="Tampilkan password">
                        <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                        <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg" class="hidden h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a20.3 20.3 0 0 1 5.06-6.06M9.9 4.24A10.94 10.94 0 0 1 12 4c7 0 11 8 11 8a20.3 20.3 0 0 1-2.35 3.42M14.12 14.12a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                    </button>
                </div>
            </div>

            <button type="submit"
                    class="w-full rounded-lg bg-primary-500 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-primary-600">
                Masuk
            </button>
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const open = document.getElementById('eye-open');
        const closed = document.getElementById('eye-closed');
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        open.classList.toggle('hidden', isHidden);
        closed.classList.toggle('hidden', !isHidden);
    }
</script>

</body>
</html>
