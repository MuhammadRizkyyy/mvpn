<?php

use App\Models\Kegiatan;
use App\Models\KegiatanCategory;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Http::fake(); // jangan panggil API terjemahan sungguhan
    $this->withSession(['admin' => true]);
});

it('membuat tab baru dengan slug otomatis', function () {
    $this->post(route('admin.kegiatan-categories.store'), [
        'name' => 'Kesehatan Masyarakat',
        'icon' => 'bi-heart-fill',
        'description' => 'Program kesehatan untuk warga.',
    ])->assertRedirect(route('admin.kegiatan-categories.index'));

    $tab = KegiatanCategory::where('slug', 'kesehatan-masyarakat')->first();

    expect($tab)->not->toBeNull()
        ->and($tab->icon)->toBe('bi-heart-fill')
        ->and($tab->show_language_pills)->toBeFalse()
        ->and($tab->translations['en']['name'] ?? null)->not->toBeEmpty();
});

it('menampilkan tab buatan admin di halaman utama', function () {
    $tab = KegiatanCategory::create(['slug' => 'kesehatan', 'name' => 'Kesehatan', 'icon' => 'bi-heart-fill', 'description' => 'Program kesehatan.', 'order' => 9]);
    Kegiatan::create(['category' => 'kesehatan', 'title' => 'Cek Kesehatan Gratis', 'order' => 0]);

    $html = $this->get('/')->assertOk()->getContent();

    expect($html)->toContain('data-tab="kesehatan"')
        ->and($html)->toContain('bi-heart-fill')
        ->and($html)->toContain('Cek Kesehatan Gratis')
        ->and($html)->toContain('Program kesehatan.');
});

it('menolak hapus tab yang masih punya program kerja', function () {
    $tab = KegiatanCategory::create(['slug' => 'kesehatan', 'name' => 'Kesehatan', 'order' => 9]);
    Kegiatan::create(['category' => 'kesehatan', 'title' => 'Cek Kesehatan', 'order' => 0]);

    $this->delete(route('admin.kegiatan-categories.destroy', $tab))->assertSessionHas('error');

    expect(KegiatanCategory::find($tab->id))->not->toBeNull();
});

it('menghapus tab yang kosong', function () {
    $tab = KegiatanCategory::create(['slug' => 'kesehatan', 'name' => 'Kesehatan', 'order' => 9]);

    $this->delete(route('admin.kegiatan-categories.destroy', $tab));

    expect(KegiatanCategory::find($tab->id))->toBeNull();
});

it('menolak program kerja dengan tab yang tidak ada', function () {
    $this->post(route('admin.kegiatan.store'), ['category' => 'tab-hantu', 'title' => 'Program X'])
        ->assertSessionHasErrors('category');

    expect(Kegiatan::where('title', 'Program X')->exists())->toBeFalse();
});

it('menyimpan urutan tab hasil drag and drop', function () {
    $ids = KegiatanCategory::orderBy('order')->pluck('id')->all();

    $this->postJson(route('admin.kegiatan-categories.reorder'), ['ids' => array_reverse($ids)])->assertOk();

    expect(KegiatanCategory::orderBy('order')->pluck('id')->all())->toBe(array_reverse($ids));
});

it('hanya menampilkan daftar kelas bahasa pada tab yang dicentang', function () {
    $html = $this->get('/')->getContent();
    expect(substr_count($html, 'data-language="jerman"'))->toBe(1);

    KegiatanCategory::where('slug', 'pendidikan')->update(['show_language_pills' => false]);
    cache()->forget('home.kegiatan_categories');

    expect($this->get('/')->getContent())->not->toContain('data-language="jerman"');
});
