@extends('admin.layout')

@section('content')
<h1 style="margin-bottom:20px">Gallery</h1>

<style>
.wrapper {
    display: grid;
    grid-template-columns: 420px 1fr;
    gap: 30px;
    margin-bottom: 40px;
}

.upload-card {
    background: #fff;
    padding: 20px;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
}

.upload-card label {
    font-size: 13px;
    font-weight: 600;
    display: block;
    margin: 12px 0 6px;
}

.upload-card input,
.upload-card textarea {
    width: 100%;
    padding: 10px 12px;
    font-size: 14px;
    border-radius: 8px;
    border: 1px solid #ddd;
    outline: none;
}

.upload-card input:focus,
.upload-card textarea:focus {
    border-color: #000;
}

.upload-card button {
    margin-top: 16px;
    width: 100%;
    padding: 12px;
    background: #000;
    color: #fff;
    border-radius: 10px;
    border: none;
    font-weight: 600;
    cursor: pointer;
}

.upload-card button:hover {
    opacity: .85;
}

.alert-success {
    padding: 14px 18px;
    background: #e6fff1;
    color: #0f5132;
    border-radius: 10px;
    font-weight: 600;
    margin-bottom: 16px;
    animation: slideFade .6s ease;
}

@keyframes slideFade {
    from { opacity: 0; transform: translateY(-12px); }
    to { opacity: 1; transform: translateY(0); }
}

.info-panel {
    background: #fff;
    padding: 24px;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(2,1fr);
    gap: 16px;
}

.info-box {
    background: #f7f7f7;
    padding: 16px;
    border-radius: 12px;
}

.info-box p {
    margin: 0;
    font-size: 13px;
    color: #666;
}

.info-box strong {
    font-size: 22px;
}
.btn-delete {
    width: 100%;
    margin-top: 10px;
    padding: 10px 0;
    border: none;
    border-radius: 8px;
    background: #ff4d4f;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all .25s ease;
}

.btn-delete:hover {
    background: #e6393b;
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(255,77,79,.35);
}

.btn-delete:active {
    transform: scale(.97);
}

.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.45);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 999;
}

.modal-box {
    background: #fff;
    width: 360px;
    padding: 22px;
    border-radius: 14px;
    box-shadow: 0 20px 50px rgba(0,0,0,.25);
    animation: pop .25s ease;
}

.modal-box h3 {
    margin: 0 0 6px;
    font-size: 18px;
}

.modal-box p {
    font-size: 14px;
    color: #666;
}

.modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
}

.btn-cancel {
    padding: 8px 14px;
    border-radius: 8px;
    border: 1px solid #ddd;
    background: #fff;
    cursor: pointer;
}

.btn-confirm {
    padding: 8px 16px;
    border-radius: 8px;
    border: none;
    background: #ff4d4f;
    color: #fff;
    font-weight: 600;
    cursor: pointer;
}

.btn-confirm:hover {
    background: #e6393b;
}

@keyframes pop {
    from {
        opacity: 0;
        transform: scale(.92);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

</style>
<script>
let formToSubmit = null;

function openDeleteModal(button) {
    formToSubmit = button.closest('form');
    document.getElementById('deleteModal').style.display = 'flex';
}

function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
    formToSubmit = null;
}

document.addEventListener('DOMContentLoaded', function () {
    const confirmBtn = document.getElementById('confirmDelete');
    if (confirmBtn) {
        confirmBtn.addEventListener('click', function () {
            if (formToSubmit) {
                formToSubmit.submit();
            }
        });
    }
});
</script>



<script>
setTimeout(() => {
    const alert = document.querySelector('.alert-success');
    if(alert) alert.style.display = 'none';
}, 3000);
</script>

{{-- FLASH MESSAGE --}}
@if(session('success'))
<div class="alert-success">
    {{ session('success') }}
</div>
@endif

<div class="wrapper">

    {{-- LEFT : UPLOAD FORM --}}
    <div class="upload-card">
        <form action="/admin/gallery" method="POST" enctype="multipart/form-data">
            @csrf

            <label>Foto</label>
            <input type="file" name="image" required>

            <label>Judul</label>
            <input type="text" name="title" placeholder="Judul foto">

            <label>Deskripsi</label>
            <textarea name="description" rows="3" placeholder="Deskripsi singkat"></textarea>

            <button type="submit">Upload Foto</button>
        </form>
    </div>

    {{-- RIGHT : INFO PANEL --}}
    <div class="info-panel">
        <h3 style="margin-bottom:16px">Gallery Info</h3>

        <div class="info-grid">
            <div class="info-box">
                <p>Total Foto</p>
                <strong>{{ $galleries->count() }}</strong>
            </div>

            <div class="info-box">
                <p>Format</p>
                <strong>JPG / PNG</strong>
            </div>

            <div class="info-box">
                <p>Max Size</p>
                <strong>5 MB</strong>
            </div>

            <div class="info-box">
                <p>Tips</p>
                <strong>Landscape lebih rapi</strong>
            </div>
        </div>
    </div>

</div>

<hr style="margin:40px 0">

{{-- GALLERY GRID --}}
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:20px">
@foreach($galleries as $item)
    <div style="border:1px solid #eee;padding:12px;border-radius:10px">
        <img src="{{ asset('storage/'.$item->image) }}" style="width:100%;border-radius:8px;margin-bottom:8px">

        <strong>{{ $item->title }}</strong>

        @if($item->description)
            <p style="font-size:13px;color:#666;margin:6px 0">
                {{ $item->description }}
            </p>
        @endif

        <form action="/admin/gallery/{{ $item->id }}" method="POST" class="delete-form">
    @csrf
    @method('DELETE')
    <button type="button" class="btn-delete" onclick="openDeleteModal(this)">
        Hapus
    </button>
</form>

    </div>
@endforeach
</div>
<div id="deleteModal" class="modal-overlay">
    <div class="modal-box">
        <h3>Hapus Foto</h3>
        <p>Foto ini akan dihapus permanen. Yakin?</p>

        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeDeleteModal()">Batal</button>
            <button class="btn-confirm" id="confirmDelete">Hapus</button>
        </div>
    </div>
</div>

@endsection
