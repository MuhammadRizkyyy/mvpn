<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LanguageClassCoordinator;
use App\Services\CloudinaryImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LanguageClassCoordinatorController extends Controller
{
    public function __construct(private CloudinaryImageService $cloudinary)
    {
    }

    public function index()
    {
        $coordinators = LanguageClassCoordinator::orderBy('language')->orderBy('order')->get()->groupBy('language');

        return view('admin.language-coordinators.index', compact('coordinators'));
    }

    public function create()
    {
        return view('admin.language-coordinators.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'language' => 'required|in:' . implode(',', array_keys(LanguageClassCoordinator::LANGUAGES)),
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'period' => 'nullable|string|max:255',
            'certificate' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            $uploaded = $this->cloudinary->upload($request->file('photo'), 'language-coordinators');
            $validated['photo'] = $uploaded['url'];
            $validated['photo_public_id'] = $uploaded['public_id'];
        }

        if ($request->hasFile('certificate')) {
            $uploadedCertificate = $this->cloudinary->upload($request->file('certificate'), 'language-coordinators/certificates');
            $validated['certificate'] = $uploadedCertificate['url'];
            $validated['certificate_public_id'] = $uploadedCertificate['public_id'];
        }

        $validated['order'] = (int) LanguageClassCoordinator::where('language', $validated['language'])->max('order') + 1;

        LanguageClassCoordinator::create($validated);

        return redirect()->route('admin.language-coordinators.index')->with('success', 'Penanggung jawab ditambahkan');
    }

    public function edit(LanguageClassCoordinator $languageCoordinator)
    {
        return view('admin.language-coordinators.edit', ['coordinator' => $languageCoordinator]);
    }

    public function update(Request $request, LanguageClassCoordinator $languageCoordinator)
    {
        $validated = $request->validate([
            'language' => 'required|in:' . implode(',', array_keys(LanguageClassCoordinator::LANGUAGES)),
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'period' => 'nullable|string|max:255',
            'certificate' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            $uploaded = $this->cloudinary->upload($request->file('photo'), 'language-coordinators');
            $validated['photo'] = $uploaded['url'];
            $validated['photo_public_id'] = $uploaded['public_id'];

            $this->cloudinary->deferredDelete($languageCoordinator->photo_public_id);
        }

        if ($request->hasFile('certificate')) {
            $uploadedCertificate = $this->cloudinary->upload($request->file('certificate'), 'language-coordinators/certificates');
            $validated['certificate'] = $uploadedCertificate['url'];
            $validated['certificate_public_id'] = $uploadedCertificate['public_id'];

            $this->cloudinary->deferredDelete($languageCoordinator->certificate_public_id);
        }

        $languageCoordinator->update($validated);

        return redirect()->route('admin.language-coordinators.index')->with('success', 'Penanggung jawab diperbarui');
    }

    public function destroy(LanguageClassCoordinator $languageCoordinator)
    {
        $this->cloudinary->deferredDelete($languageCoordinator->photo_public_id);
        $this->cloudinary->deferredDelete($languageCoordinator->certificate_public_id);

        $languageCoordinator->delete();

        return back()->with('success', 'Penanggung jawab dihapus');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'language' => 'required|in:' . implode(',', array_keys(LanguageClassCoordinator::LANGUAGES)),
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:language_class_coordinators,id',
        ]);

        $ids = LanguageClassCoordinator::where('language', $validated['language'])
            ->whereIn('id', $validated['ids'])
            ->pluck('id');

        foreach ($validated['ids'] as $index => $id) {
            if ($ids->contains($id)) {
                LanguageClassCoordinator::where('id', $id)->update(['order' => $index]);
            }
        }

        Cache::forget('home.language_coordinators');

        return response()->json(['status' => 'ok']);
    }
}
