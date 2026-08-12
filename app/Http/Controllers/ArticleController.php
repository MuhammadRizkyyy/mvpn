<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::published()->orderBy('order')->latest('id')->paginate(9);

        return view('pages.artikel', compact('articles'));
    }

    public function show(Article $artikel)
    {
        abort_unless($artikel->is_published, 404);

        if ($artikel->is_external) {
            return redirect()->away($artikel->source_url);
        }

        $related = Article::published()
            ->where('id', '!=', $artikel->id)
            ->orderBy('order')
            ->latest('id')
            ->take(3)
            ->get();

        return view('pages.artikel-show', ['article' => $artikel, 'related' => $related]);
    }
}
