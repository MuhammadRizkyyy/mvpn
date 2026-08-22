<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KegiatanCategory;
use App\Services\TranslationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class KegiatanCategoryController extends Controller
{
    public function index()
    {
        $categories = KegiatanCategory::withCount('kegiatans')->orderBy('order')->orderBy('id')->get();

        return view('admin.kegiatan.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.kegiatan.categories.create');
    }

    public function store(Request $request, TranslationService $translator)
    {
        $validated = $this->validated($request);

        KegiatanCategory::create($validated + [
            'slug' => $this->uniqueSlug($validated['name']),
            'order' => (int) KegiatanCategory::max('order') + 1,
            'translations' => $this->translate($translator, $validated),
        ]);

        return redirect()->route('admin.kegiatan-categories.index')->with('success', 'Tab program kerja ditambahkan');
    }

    public function edit(KegiatanCategory $kegiatanCategory)
    {
        return view('admin.kegiatan.categories.edit', ['category' => $kegiatanCategory]);
    }

    public function update(Request $request, KegiatanCategory $kegiatanCategory, TranslationService $translator)
    {
        $validated = $this->validated($request);

        $kegiatanCategory->update($validated + [
            'translations' => $this->translate($translator, $validated),
        ]);

        return redirect()->route('admin.kegiatan-categories.index')->with('success', 'Tab program kerja diperbarui');
    }

    public function destroy(KegiatanCategory $kegiatanCategory)
    {
        if ($kegiatanCategory->kegiatans()->exists()) {
            return back()->with('error', 'Tab ini masih punya program kerja. Pindahkan atau hapus isinya dulu.');
        }

        $kegiatanCategory->delete();

        return back()->with('success', 'Tab program kerja dihapus');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:kegiatan_categories,id',
        ]);

        foreach ($validated['ids'] as $index => $id) {
            KegiatanCategory::where('id', $id)->update(['order' => $index]);
        }

        Cache::forget('home.kegiatan_categories');

        return response()->json(['status' => 'ok']);
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'show_language_pills' => 'nullable|boolean',
        ]);

        $validated['show_language_pills'] = $request->boolean('show_language_pills');

        return $validated;
    }

    private function uniqueSlug(string $name): string
    {
        $base = Str::slug($name) ?: 'tab';
        $slug = $base;
        $i = 2;

        while (KegiatanCategory::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }

    private function translate(TranslationService $translator, array $validated): array
    {
        return $translator->translateFields(
            ['name' => $validated['name'], 'description' => (string) ($validated['description'] ?? '')],
            config('translation.target_locales'),
            config('translation.source_locale')
        );
    }
}
