<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MisiItem;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function edit()
    {
        $visiMisi = VisiMisi::singleton();
        $misiItems = MisiItem::orderBy('order')->get();

        return view('admin.visimisi.edit', compact('visiMisi', 'misiItems'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'visi_text' => 'nullable|string',
        ]);

        VisiMisi::singleton()->update($validated);

        return back()->with('success', 'Visi diperbarui');
    }
}
