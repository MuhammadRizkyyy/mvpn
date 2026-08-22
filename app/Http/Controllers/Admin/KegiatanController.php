<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Kegiatan;
use App\Services\TranslationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::orderBy('category')->orderBy('order')->get()->groupBy('category');
        $categories = \App\Models\KegiatanCategory::ordered();

        return view('admin.kegiatan.index', compact('kegiatans', 'categories'));
    }

    public function create()
    {
        $categories = \App\Models\KegiatanCategory::ordered();

        return view('admin.kegiatan.create', compact('categories'));
    }

    public function store(Request $request, TranslationService $translator)
    {
        $validated = $request->validate([
            'category' => 'required|exists:kegiatan_categories,slug',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_coming_soon' => 'nullable|boolean',
        ]);
        $validated['is_coming_soon'] = $request->boolean('is_coming_soon');
        $validated['description'] = Article::sanitizeContent($validated['description'] ?? null);
        $validated['order'] = Kegiatan::where('category', $validated['category'])->max('order') + 1;
        $validated['translations'] = $this->translateFields($translator, $validated['title'], $validated['description']);

        Kegiatan::create($validated);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Program kerja ditambahkan');
    }

    public function edit(Kegiatan $kegiatan)
    {
        $categories = \App\Models\KegiatanCategory::ordered();

        return view('admin.kegiatan.edit', compact('kegiatan', 'categories'));
    }

    public function update(Request $request, Kegiatan $kegiatan, TranslationService $translator)
    {
        $validated = $request->validate([
            'category' => 'required|exists:kegiatan_categories,slug',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_coming_soon' => 'nullable|boolean',
        ]);
        $validated['is_coming_soon'] = $request->boolean('is_coming_soon');
        $validated['description'] = Article::sanitizeContent($validated['description'] ?? null);

        $validated['translations'] = $this->translateFields($translator, $validated['title'], $validated['description']);

        $kegiatan->update($validated);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Program kerja diperbarui');
    }

    /**
     * @return array<string, array<string, string>>
     */
    private function translateFields(TranslationService $translator, ?string $title, ?string $description): array
    {
        return $translator->translateFields(
            ['title' => (string) $title, 'description' => TranslationService::htmlToPlain($description)],
            config('translation.target_locales'),
            config('translation.source_locale')
        );
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();

        return back()->with('success', 'Program kerja dihapus');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|exists:kegiatan_categories,slug',
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:kegiatans,id',
        ]);

        $ids = Kegiatan::where('category', $validated['category'])
            ->whereIn('id', $validated['ids'])
            ->pluck('id');

        foreach ($validated['ids'] as $index => $id) {
            if ($ids->contains($id)) {
                Kegiatan::where('id', $id)->update(['order' => $index]);
            }
        }

        Cache::forget('home.kegiatans');

        return response()->json(['status' => 'ok']);
    }
}
