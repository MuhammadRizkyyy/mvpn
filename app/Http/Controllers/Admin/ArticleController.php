<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\CloudinaryImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function __construct(private CloudinaryImageService $cloudinary)
    {
    }

    public function index()
    {
        $articles = Article::orderBy('order')->orderByDesc('id')->get();

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        if (blank($validated['slug'] ?? null)) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $uploaded = $this->cloudinary->upload($request->file('image'), 'articles');
        $validated['image'] = $uploaded['url'];
        $validated['image_public_id'] = $uploaded['public_id'];
        $validated['order'] = (int) Article::max('order') + 1;

        Article::create($validated);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel ditambahkan');
    }

    public function edit(Article $artikel)
    {
        return view('admin.articles.edit', ['article' => $artikel]);
    }

    public function update(Request $request, Article $artikel)
    {
        $validated = $this->validated($request, $artikel->id);

        if (blank($validated['slug'] ?? null)) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            $uploaded = $this->cloudinary->upload($request->file('image'), 'articles');
            $validated['image'] = $uploaded['url'];
            $validated['image_public_id'] = $uploaded['public_id'];

            $this->cloudinary->deferredDelete($artikel->image_public_id);
        }

        $artikel->update($validated);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel diperbarui');
    }

    public function destroy(Article $artikel)
    {
        $this->cloudinary->deferredDelete($artikel->image_public_id);

        $artikel->delete();

        return back()->with('success', 'Artikel dihapus');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:articles,id',
        ]);

        foreach ($validated['ids'] as $index => $id) {
            Article::where('id', $id)->update(['order' => $index]);
        }

        Cache::forget('home.articles');

        return response()->json(['status' => 'ok']);
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        $validated = $request->validate([
            'category' => 'required|in:' . implode(',', array_keys(Article::CATEGORIES)),
            'title' => 'required|string|max:255',
            'slug' => 'nullable|alpha_dash|max:255|unique:articles,slug,' . ($ignoreId ?? 'NULL') . ',id',
            'excerpt' => 'required|string|max:255',
            'content' => 'nullable|required_without:source_url|string',
            'image' => ($ignoreId ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png|max:5120',
            'source_name' => 'nullable|required_with:source_url|string|max:255',
            'source_url' => 'nullable|url|max:255',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        $validated['content'] = Article::sanitizeContent($validated['content'] ?? null);

        return $validated;
    }
}
