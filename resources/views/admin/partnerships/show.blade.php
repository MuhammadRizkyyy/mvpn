@extends('admin.layout')

@section('content')

<div class="container-fluid px-4">

    <div class="mb-4">
        <a href="{{ route('admin.partnerships.index') }}"
           class="text-decoration-none text-muted small">
            ← Kembali ke daftar pengajuan
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <h4 class="fw-bold mb-4">Detail Pengajuan Kerjasama</h4>

            <div class="row mb-3">
                <div class="col-md-3 text-muted">Nama Institusi</div>
                <div class="col-md-9 fw-semibold">{{ $partnership->institution_name }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 text-muted">PIC</div>
                <div class="col-md-9">{{ $partnership->pic_name }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 text-muted">Email</div>
                <div class="col-md-9">{{ $partnership->email }}</div>
            </div>

            <div class="row mb-4">
                <div class="col-md-3 text-muted">Rangkuman Kerjasama</div>
                <div class="col-md-9">
                    <div class="bg-light rounded p-3">
                        {{ $partnership->summary }}
                    </div>
                </div>
            </div>

            @if($partnership->proposal_file)
            <div class="row mb-4">
                <div class="col-md-3 text-muted">Proposal</div>
                <div class="col-md-9">
                    <a href="{{ asset('storage/'.$partnership->proposal_file) }}"
                       class="btn btn-outline-dark btn-sm"
                       target="_blank">
                        Download Proposal
                    </a>
                </div>
            </div>
            @endif

            <hr>

            <div class="d-flex gap-2">
                <form method="POST"
                      action="{{ route('admin.partnerships.approve', $partnership->id) }}">
                    @csrf
                    <button class="btn btn-success">
                        Approve
                    </button>
                </form>

                <form method="POST"
                      action="{{ route('admin.partnerships.reject', $partnership->id) }}">
                    @csrf
                    <button class="btn btn-outline-danger">
                        Reject
                    </button>
                </form>
            </div>

        </div>
    </div>

</div>

@endsection
