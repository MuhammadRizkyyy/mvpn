<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .topbar {
            background: #ffffff;
            border-bottom: 1px solid #e5e5e5;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        }
        .small-muted {
            font-size: 13px;
            color: #888;
        }
    </style>
</head>
<body>

<!-- TOPBAR -->
<nav class="navbar topbar px-4 py-3">
    <span class="fw-bold">Admin Panel</span>

    <div class="d-flex gap-3">
        <a href="{{ url('/admin/dashboard') }}" class="text-decoration-none">Dashboard</a>
        <a href="{{ url('/admin/partnerships') }}" class="text-decoration-none">Pengajuan</a>
        <a href="{{ url('/admin/gallery') }}" class="text-decoration-none">Foto kegiatan</a>


        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline-dark btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="container-fluid mt-4">
    @yield('content')
</div>

</body>
</html>
