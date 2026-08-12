<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MisiItem;
use App\Models\VisiMisi;
use App\Services\TranslationService;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function edit()
    {
        $visiMisi = VisiMisi::singleton();
        $misiItems = MisiItem::orderBy('order')->get();

        return view('admin.visimisi.edit', compact('visiMisi', 'misiItems'));
    }

    public function update(Request $request, TranslationService $translator)
    {
        $validated = $request->validate([
            'visi_text' => 'nullable|string',
        ]);

        $validated['translations'] = $translator->translateFields(
            $validated,
            config('translation.target_locales'),
            config('translation.source_locale')
        );

        VisiMisi::singleton()->update($validated);

        return back()->with('success', 'Visi diperbarui');
    }
}
