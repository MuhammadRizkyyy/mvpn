@extends('admin.layout')

@section('content')

<div class="container-fluid px-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Pengajuan Kerjasama</h4>
        <span class="text-muted small">
            Total: {{ $partnerships->count() }} pengajuan
        </span>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Institusi</th>
                        <th>PIC</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($partnerships as $p)
                    <tr>
                        <td class="fw-semibold">{{ $p->institution_name }}</td>
                        <td>{{ $p->pic_name }}</td>
                        <td>{{ $p->email }}</td>
                        <td>
                            @if($p->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($p->status === 'approved')
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.partnerships.show', $p->id) }}"
                               class="btn btn-sm btn-outline-dark">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Belum ada pengajuan kerjasama
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection
