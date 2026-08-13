<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::orderBy('category')->orderBy('order')->get()->groupBy('category');

        return view('admin.kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:' . implode(',', array_keys(Kegiatan::CATEGORIES)),
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_coming_soon' => 'nullable|boolean',
        ]);
        $validated['is_coming_soon'] = $request->boolean('is_coming_soon');
        $validated['order'] = Kegiatan::where('category', $validated['category'])->max('order') + 1;

        Kegiatan::create($validated);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Program kerja ditambahkan');
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'category' => 'required|in:' . implode(',', array_keys(Kegiatan::CATEGORIES)),
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_coming_soon' => 'nullable|boolean',
        ]);
        $validated['is_coming_soon'] = $request->boolean('is_coming_soon');

        $kegiatan->update($validated);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Program kerja diperbarui');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();

        return back()->with('success', 'Program kerja dihapus');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:' . implode(',', array_keys(Kegiatan::CATEGORIES)),
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
