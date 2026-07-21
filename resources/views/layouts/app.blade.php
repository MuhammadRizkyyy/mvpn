<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <style>
        body { font-family: 'Figtree', sans-serif; }

        .kotak {
            background:#fff; border-radius:10px; padding:2rem; box-shadow:0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .kotak:hover { transform:translateY(-5px); box-shadow:0 8px 20px rgba(0,0,0,0.2); }

        .fade-left { opacity:0; animation:fadeInLeft 1s forwards; animation-delay:0.2s; }
        .fade-right { opacity:0; animation:fadeInRight 1s forwards; animation-delay:0.4s; }
        .fade-down { opacity:0; animation:fadeInDown 1s forwards; animation-delay:0.1s; }

        @keyframes fadeInLeft { from {opacity:0; transform:translateX(-30px);} to {opacity:1; transform:translateX(0);} }
        @keyframes fadeInRight { from {opacity:0; transform:translateX(30px);} to {opacity:1; transform:translateX(0);} }
        @keyframes fadeInDown { from {opacity:0; transform:translateY(-20px);} to {opacity:1; transform:translateY(0);} }

        
        .tab-wrapper { position:relative; min-height:500px; }
        .tab-header { display:grid; grid-template-columns:repeat(3,1fr); text-align:center; border-bottom:1px solid #ddd; margin-bottom:60px; }
        .tab-header span { padding-bottom:15px; font-weight:600; cursor:pointer; }
        .tab-header .active { border-bottom:2px solid #000; }
        .tab-content {
            opacity:0; transform:translateY(20px);
            position:absolute; top:0; left:0; width:100%;
            transition: opacity 0.4s ease, transform 0.4s ease;
            pointer-events:none;
        }
        .tab-content.active { opacity:1; transform:translateY(0); position:relative; pointer-events:auto; }

        .checklist { list-style:none; padding-left:0; }
        .checklist>li { position:relative; padding-left:28px; margin-bottom:15px; }
        .checklist>li::before { content:"✓"; position:absolute; left:0; }
        .checklist ul { list-style:none; padding-left:28px; }
        .checklist ul li { position:relative; padding-left:22px; margin-bottom:8px; }
        .checklist ul li::before { content:"✓"; position:absolute; left:0; }
        .soon { font-style:italic; color:#777; }

        .page-wrapper { max-width:1100px; margin:80px auto; padding:0 20px; }
        .title { text-align:center; font-size:32px; font-weight:700; }
        .title-line { width:60px; height:3px; background:#000; margin:10px auto 50px; }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Tab JS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

                    btn.classList.add('active');
                    document.getElementById(btn.dataset.tab).classList.add('active');
                });
            });
        });
    </script>
</body>
</html>
