<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengurusSection;
use App\Services\TranslationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class PengurusSectionController extends Controller
{
    public function index()
    {
        $sections = PengurusSection::withCount('pengurus')->orderBy('order')->orderBy('id')->get();

        return view('admin.pengurus.sections', compact('sections'));
    }

    public function store(Request $request, TranslationService $translator)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        PengurusSection::create([
            'slug' => $this->uniqueSlug($validated['name']),
            'name' => $validated['name'],
            'order' => (int) PengurusSection::max('order') + 1,
            'translations' => $this->translate($translator, $validated['name']),
        ]);

        return back()->with('success', 'Divisi ditambahkan');
    }

    public function update(Request $request, PengurusSection $pengurusSection, TranslationService $translator)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $pengurusSection->update([
            'name' => $validated['name'],
            'translations' => $this->translate($translator, $validated['name']),
        ]);

        return back()->with('success', 'Divisi diperbarui');
    }

    public function destroy(PengurusSection $pengurusSection)
    {
        if ($pengurusSection->pengurus()->exists()) {
            return back()->with('error', 'Divisi masih punya pengurus. Pindahkan atau hapus pengurusnya dulu.');
        }

        $pengurusSection->delete();

        return back()->with('success', 'Divisi dihapus');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:pengurus_sections,id',
        ]);

        foreach ($validated['ids'] as $index => $id) {
            PengurusSection::where('id', $id)->update(['order' => $index]);
        }

        Cache::forget('home.pengurus_sections');

        return response()->json(['status' => 'ok']);
    }

    private function uniqueSlug(string $name): string
    {
        $base = Str::slug($name) ?: 'divisi';
        $slug = $base;
        $i = 2;

        while (PengurusSection::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }

    private function translate(TranslationService $translator, string $name): array
    {
        return $translator->translateFields(
            ['name' => $name],
            config('translation.target_locales'),
            config('translation.source_locale')
        );
    }
}
