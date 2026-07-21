@extends('admin.layout')

@section('content')

<div class="row">

    <!-- MAIN CONTENT -->
    <div class="col-md-9 px-4">
        <h4 class="fw-bold mb-4">Dashboard</h4>

        <!-- SUMMARY -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card p-3">
                    <div class="small-muted">Total Kerjasama</div>
                    <h3 class="fw-bold">{{ $totalKerjasama }}</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3">
                    <div class="small-muted">Pending Review</div>
                    <h3 class="fw-bold">{{ $pendingReview }}</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3">
                    <div class="small-muted">Total Galeri</div>
                    <h3 class="fw-bold">{{ $totalGaleri }}</h3>
                </div>
            </div>
        </div>

        <!-- TABLE -->
        <div class="card p-4">
            <h6 class="fw-bold mb-3">Pengajuan Terbaru</h6>
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Institusi</th>
                        <th>PIC</th>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($latestPartnerships as $p)
                    <tr>
                        <td>{{ $p->institution_name }}</td>
                        <td>{{ $p->pic_name }}</td>
                        <td>{{ $p->email }}</td>
                        <td>
                            <span class="badge bg-warning text-dark">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="col-md-3 px-4">
        <div class="card p-3 mb-3">
            <h6 class="fw-bold">Aktivitas</h6>
            <p class="small-muted mb-1">Pengajuan baru realtime</p>
        </div>

        <div class="card p-3">
            <h6 class="fw-bold">System</h6>
            <span class="badge bg-success">Online</span>
        </div>
    </div>

</div>

@endsection
