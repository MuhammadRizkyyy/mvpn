<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Gallery;
use App\Services\CloudinaryImageService;
use App\Services\TranslationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdminGalleryController extends Controller
{
    public function __construct(
        private CloudinaryImageService $cloudinary,
    ) {
    }

    public function index()
    {
        $galleries = Gallery::orderBy('order')->orderByDesc('id')->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    public function store(Request $request, TranslationService $translator)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $uploaded = $this->cloudinary->upload($request->file('image'), 'gallery');
        $description = Article::sanitizeContent($request->description);

        Gallery::create([
            'image' => $uploaded['url'],
            'image_public_id' => $uploaded['public_id'],
            'title' => $request->title,
            'description' => $description,
            'order' => (int) Gallery::max('order') + 1,
            'translations' => $this->translateFields($translator, $request->title, $description),
        ]);

        return back()->with('success', 'Foto berhasil diupload');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:galleries,id',
        ]);

        foreach ($validated['ids'] as $index => $id) {
            Gallery::where('id', $id)->update(['order' => $index]);
        }

        Cache::forget('home.galleries');

        return response()->json(['status' => 'ok']);
    }

    public function update(Request $request, $id, TranslationService $translator)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $description = Article::sanitizeContent($request->description);

        $data = [
            'title' => $request->title,
            'description' => $description,
            'translations' => $this->translateFields($translator, $request->title, $description),
        ];

        if ($request->hasFile('image')) {
            $uploaded = $this->cloudinary->upload($request->file('image'), 'gallery');
            $data['image'] = $uploaded['url'];
            $data['image_public_id'] = $uploaded['public_id'];

            $this->cloudinary->deferredDelete($gallery->image_public_id);
        }

        $gallery->update($data);

        return back()->with('success', 'Foto berhasil diperbarui');
    }

    /**
     * @return array<string, array<string, string>>
     */
    private function translateFields(TranslationService $translator, ?string $title, ?string $description): array
    {
        $plainDescription = html_entity_decode(strip_tags((string) $description), ENT_QUOTES);

        return $translator->translateFields(
            ['title' => (string) $title, 'description' => $plainDescription],
            config('translation.target_locales'),
            config('translation.source_locale')
        );
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        $this->cloudinary->deferredDelete($gallery->image_public_id);
        $gallery->delete();

        return back()->with('success', 'Foto dihapus');
    }
}
