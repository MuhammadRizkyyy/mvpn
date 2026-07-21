<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $path = $request->file('image')->store('gallery', 'public');
Gallery::create([
    'image' => $path,
    'title' => $request->title,
    'description' => $request->description,
        ]);

        return back()->with('success', 'Foto berhasil diupload');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();

        return back()->with('success', 'Foto dihapus');
    }
}
