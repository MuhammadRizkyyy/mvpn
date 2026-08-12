<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use App\Services\CloudinaryImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MitraController extends Controller
{
    public function __construct(private CloudinaryImageService $cloudinary)
    {
    }

    public function index()
    {
        $mitras = Mitra::orderBy('category')->orderBy('order')->get()->groupBy('category');

        return view('admin.mitra.index', compact('mitras'));
    }

    public function create()
    {
        return view('admin.mitra.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:' . implode(',', array_keys(Mitra::CATEGORIES)),
            'name' => 'nullable|string|max:255',
            'logo' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'link' => 'nullable|url|max:255',
        ]);

        $uploaded = $this->cloudinary->upload($request->file('logo'), 'mitra');
        $validated['logo'] = $uploaded['url'];
        $validated['logo_public_id'] = $uploaded['public_id'];

        Mitra::create($validated);

        return redirect()->route('admin.mitra.index')->with('success', 'Mitra ditambahkan');
    }

    public function edit(Mitra $mitra)
    {
        return view('admin.mitra.edit', compact('mitra'));
    }

    public function update(Request $request, Mitra $mitra)
    {
        $validated = $request->validate([
            'category' => 'required|in:' . implode(',', array_keys(Mitra::CATEGORIES)),
            'name' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'link' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('logo')) {
            $uploaded = $this->cloudinary->upload($request->file('logo'), 'mitra');
            $validated['logo'] = $uploaded['url'];
            $validated['logo_public_id'] = $uploaded['public_id'];

            $this->cloudinary->deferredDelete($mitra->logo_public_id);
        }

        $mitra->update($validated);

        return redirect()->route('admin.mitra.index')->with('success', 'Mitra diperbarui');
    }

    public function destroy(Mitra $mitra)
    {
        $this->cloudinary->deferredDelete($mitra->logo_public_id);

        $mitra->delete();

        return back()->with('success', 'Mitra dihapus');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:' . implode(',', array_keys(Mitra::CATEGORIES)),
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:mitras,id',
        ]);

        $ids = Mitra::where('category', $validated['category'])
            ->whereIn('id', $validated['ids'])
            ->pluck('id');

        foreach ($validated['ids'] as $index => $id) {
            if ($ids->contains($id)) {
                Mitra::where('id', $id)->update(['order' => $index]);
            }
        }

        Cache::forget('home.mitra');

        return response()->json(['status' => 'ok']);
    }
}
