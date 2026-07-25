<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function edit()
    {
        $about = About::singleton();

        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'paragraph_1' => 'nullable|string',
            'paragraph_2' => 'nullable|string',
            'paragraph_3' => 'nullable|string',
        ]);

        About::singleton()->update($validated);

        return back()->with('success', 'Konten Tentang diperbarui');
    }
}
