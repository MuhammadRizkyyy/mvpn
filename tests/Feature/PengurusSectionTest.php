<?php

use App\Models\Pengurus;
use App\Models\PengurusSection;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Http::fake(); // jangan panggil API terjemahan sungguhan
    $this->withSession(['admin' => true]);
});

it('membuat divisi baru dengan slug otomatis', function () {
    $this->post(route('admin.pengurus-sections.store'), ['name' => 'Direktorat Hubungan Masyarakat'])
        ->assertRedirect();

    expect(PengurusSection::where('slug', 'direktorat-hubungan-masyarakat')->exists())->toBeTrue();
});

it('memberi slug unik saat nama divisi sama', function () {
    PengurusSection::create(['slug' => 'humas', 'name' => 'Humas', 'order' => 0]);

    $this->post(route('admin.pengurus-sections.store'), ['name' => 'Humas']);

    expect(PengurusSection::where('slug', 'humas-2')->exists())->toBeTrue();
});

it('menolak hapus divisi yang masih punya pengurus', function () {
    $section = PengurusSection::create(['slug' => 'humas', 'name' => 'Humas', 'order' => 0]);
    Pengurus::create(['section' => 'humas', 'name' => 'Budi', 'position' => 'Ketua', 'order' => 0]);

    $this->delete(route('admin.pengurus-sections.destroy', $section))->assertSessionHas('error');

    expect(PengurusSection::find($section->id))->not->toBeNull();
});

it('menghapus divisi yang kosong', function () {
    $section = PengurusSection::create(['slug' => 'humas', 'name' => 'Humas', 'order' => 0]);

    $this->delete(route('admin.pengurus-sections.destroy', $section));

    expect(PengurusSection::find($section->id))->toBeNull();
});

it('menolak pengurus dengan divisi yang tidak ada', function () {
    $this->post(route('admin.pengurus.store'), [
        'section' => 'divisi-hantu',
        'name' => 'Budi',
        'position' => 'Ketua',
    ])->assertSessionHasErrors('section');

    expect(Pengurus::count())->toBe(0);
});

it('menyimpan urutan baru hasil drag and drop', function () {
    $a = PengurusSection::create(['slug' => 'a', 'name' => 'A', 'order' => 0]);
    $b = PengurusSection::create(['slug' => 'b', 'name' => 'B', 'order' => 1]);
    $c = PengurusSection::create(['slug' => 'c', 'name' => 'C', 'order' => 2]);

    $this->postJson(route('admin.pengurus-sections.reorder'), ['ids' => [$c->id, $a->id, $b->id]])
        ->assertOk();

    expect(PengurusSection::whereIn('slug', ['a', 'b', 'c'])->orderBy('order')->pluck('slug')->all())->toBe(['c', 'a', 'b']);
});
