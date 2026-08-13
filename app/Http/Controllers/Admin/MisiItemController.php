<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MisiItem;
use App\Services\TranslationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MisiItemController extends Controller
{
    public function store(Request $request, TranslationService $translator)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['translations'] = $translator->translateFields(
            ['text' => $validated['text']],
            config('translation.target_locales'),
            config('translation.source_locale')
        );

        MisiItem::create($validated);

        return back()->with('success', 'Poin misi ditambahkan');
    }

    public function update(Request $request, MisiItem $misiItem, TranslationService $translator)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['translations'] = $translator->translateFields(
            ['text' => $validated['text']],
            config('translation.target_locales'),
            config('translation.source_locale')
        );

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

        Cache::forget('home.misiitems');

        return response()->json(['status' => 'ok']);
    }
}
