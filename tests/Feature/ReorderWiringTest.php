<?php

use App\Models\Article;
use App\Models\Gallery;
use App\Models\LanguageClassCoordinator;
use App\Models\Kegiatan;
use App\Models\MisiItem;
use App\Models\Mitra;
use App\Models\Pengurus;
use App\Models\PengurusSection;
use App\Models\VisiMisi;

/**
 * Semua halaman yang bisa di-drag memakai satu handler generik di app.js,
 * yang hanya menyala lewat atribut `data-reorder-url`.
 */
it('memasang atribut reorder generik di semua halaman yang bisa diurutkan', function () {
    $this->withSession(['admin' => true]);

    Article::create(['category' => 'berita', 'title' => 'Judul', 'slug' => 'judul', 'excerpt' => 'ringkas', 'content' => 'isi', 'image' => 'x.jpg', 'published_at' => now(), 'order' => 0]);
    Gallery::create(['image' => 'x.jpg', 'title' => 'Foto', 'order' => 0]);
    LanguageClassCoordinator::create(['language' => 'jerman', 'name' => 'Budi', 'role' => 'PJ', 'order' => 0]);
    Pengurus::create(['section' => 'bod', 'name' => 'Budi', 'position' => 'Presiden', 'order' => 0]);
    PengurusSection::create(['slug' => 'humas', 'name' => 'Humas', 'order' => 9]);
    Kegiatan::create(['category' => 'pendidikan', 'title' => 'Kelas PKBM', 'order' => 0]);
    Mitra::create(['category' => 'media', 'logo' => 'x.png', 'order' => 0]);
    VisiMisi::create(['visi' => 'Visi kami']);
    MisiItem::create(['text' => 'Misi pertama', 'order' => 0]);

    $pages = [
        '/admin/artikel' => ['/admin/artikel/reorder', null],
        '/admin/gallery' => ['/admin/gallery/reorder', null],
        '/admin/language-coordinators' => ['/admin/language-coordinators/reorder', 'language'],
        '/admin/pengurus' => ['/admin/pengurus/reorder', 'section'],
        '/admin/divisi' => ['/admin/divisi/reorder', null],
        '/admin/kegiatan' => ['/admin/kegiatan/reorder', 'category'],
        '/admin/tab-proker' => ['/admin/tab-proker/reorder', null],
        '/admin/mitra' => ['/admin/mitra/reorder', 'category'],
        '/admin/visi-misi' => ['/admin/misi/reorder', null],
    ];

    foreach ($pages as $uri => [$reorderUrl, $groupKey]) {
        $html = $this->get($uri)->assertOk()->getContent();

        expect($html)->toContain('data-reorder-url="'.url($reorderUrl).'"', $uri)
            ->and($html)->toContain('js-reorder-item', $uri)
            ->and($html)->toContain('js-drag-handle', $uri)
            // JS drag inline sudah dihapus, tidak boleh muncul lagi
            ->and($html)->not->toContain('js-reorder-list', $uri)
            ->and($html)->not->toContain('js-reorder-grid', $uri)
            ->and($html)->not->toContain('js-reorder-card', $uri);

        if ($groupKey) {
            expect($html)->toContain('data-reorder-key="'.$groupKey.'"', $uri);
        }
    }
});
