<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MisiItem;
use Illuminate\Http\Request;

class MisiItemController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'order' => 'nullable|integer|min:0',
        ]);

        MisiItem::create($validated);

        return back()->with('success', 'Poin misi ditambahkan');
    }

    public function update(Request $request, MisiItem $misiItem)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'order' => 'nullable|integer|min:0',
        ]);

        $misiItem->update($validated);

        return back()->with('success', 'Poin misi diperbarui');
    }

    public function destroy(MisiItem $misiItem)
    {
        $misiItem->delete();

        return back()->with('success', 'Poin misi dihapus');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:misi_items,id',
        ]);

        foreach ($validated['ids'] as $index => $id) {
            MisiItem::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['status' => 'ok']);
    }
}
