<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    public function index()
    {
        $pengurus = Pengurus::orderBy('section')->orderBy('order')->get()->groupBy('section');

        return view('admin.pengurus.index', compact('pengurus'));
    }

    public function create()
    {
        return view('admin.pengurus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'section' => 'required|in:' . implode(',', array_keys(Pengurus::SECTIONS)),
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'instagram_url' => 'nullable|url|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('pengurus', 'public');
        }

        Pengurus::create($validated);

        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus ditambahkan');
    }

    public function edit(Pengurus $pengurus)
    {
        return view('admin.pengurus.edit', compact('pengurus'));
    }

    public function update(Request $request, Pengurus $pengurus)
    {
        $validated = $request->validate([
            'section' => 'required|in:' . implode(',', array_keys(Pengurus::SECTIONS)),
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'instagram_url' => 'nullable|url|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('photo')) {
            if ($pengurus->photo) {
                Storage::disk('public')->delete($pengurus->photo);
            }
            $validated['photo'] = $request->file('photo')->store('pengurus', 'public');
        }

        $pengurus->update($validated);

        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus diperbarui');
    }

    public function destroy(Pengurus $pengurus)
    {
        if ($pengurus->photo) {
            Storage::disk('public')->delete($pengurus->photo);
        }

        $pengurus->delete();

        return back()->with('success', 'Pengurus dihapus');
    }
}
