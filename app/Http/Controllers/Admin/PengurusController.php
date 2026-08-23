<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use App\Services\CloudinaryImageService;
use App\Services\TranslationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PengurusController extends Controller
{
    public function __construct(private CloudinaryImageService $cloudinary)
    {
    }

    public function index()
    {
        $pengurus = Pengurus::orderBy('section')->orderBy('order')->get()->groupBy('section');
        $sections = \App\Models\PengurusSection::ordered();

        return view('admin.pengurus.index', compact('pengurus', 'sections'));
    }

    public function create()
    {
        $sections = \App\Models\PengurusSection::ordered();

        return view('admin.pengurus.create', compact('sections'));
    }

    public function store(Request $request, TranslationService $translator)
    {
        $validated = $request->validate([
            'section' => 'required|exists:pengurus_sections,slug',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $uploaded = $this->cloudinary->upload($request->file('photo'), 'pengurus');
            $validated['photo'] = $uploaded['url'];
            $validated['photo_public_id'] = $uploaded['public_id'];
        }

        $validated['order'] = (int) Pengurus::where('section', $validated['section'])->max('order') + 1;
        $validated['translations'] = $this->translateFields($translator, ['position' => $validated['position']]);

        Pengurus::create($validated);

        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus ditambahkan');
    }

    public function edit(Pengurus $pengurus)
    {
        $sections = \App\Models\PengurusSection::ordered();

        return view('admin.pengurus.edit', compact('pengurus', 'sections'));
    }

    public function update(Request $request, Pengurus $pengurus, TranslationService $translator)
    {
        $validated = $request->validate([
            'section' => 'required|exists:pengurus_sections,slug',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $uploaded = $this->cloudinary->upload($request->file('photo'), 'pengurus');
            $validated['photo'] = $uploaded['url'];
            $validated['photo_public_id'] = $uploaded['public_id'];

            $this->cloudinary->deferredDelete($pengurus->photo_public_id);
        }

        $validated['translations'] = $this->translateFields($translator, ['position' => $validated['position']]);

        $pengurus->update($validated);

        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus diperbarui');
    }

    public function destroy(Pengurus $pengurus)
    {
        $this->cloudinary->deferredDelete($pengurus->photo_public_id);

        $pengurus->delete();

        return back()->with('success', 'Pengurus dihapus');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'section' => 'required|exists:pengurus_sections,slug',
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:pengurus,id',
        ]);

        $ids = Pengurus::where('section', $validated['section'])
            ->whereIn('id', $validated['ids'])
            ->pluck('id');

        foreach ($validated['ids'] as $index => $id) {
            if ($ids->contains($id)) {
                Pengurus::where('id', $id)->update(['order' => $index]);
            }
        }

        Cache::forget('home.pengurus');

        return response()->json(['status' => 'ok']);
    }

    /**
     * @return array<string, array<string, string>>
     */
    private function translateFields(TranslationService $translator, array $fields): array
    {
        return $translator->translateFields(
            $fields,
            config('translation.target_locales'),
            config('translation.source_locale')
        );
    }
}
