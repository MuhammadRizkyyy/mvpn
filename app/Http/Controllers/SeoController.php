<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Gallery;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function robots(): Response
    {
        $lines = [
            'User-agent: *',
            'Disallow: /admin',
            '',
            'Sitemap: ' . url('/sitemap.xml'),
        ];

        return response(implode("\n", $lines) . "\n", 200, [
            'Content-Type' => 'text/plain',
        ]);
    }

    public function sitemap(): Response
    {
        $urls = collect([
            ['loc' => url('/'), 'lastmod' => now(), 'priority' => '1.0'],
            ['loc' => route('artikel.index'), 'lastmod' => now(), 'priority' => '0.8'],
            ['loc' => route('galeri.index'), 'lastmod' => Gallery::max('updated_at') ?? now(), 'priority' => '0.6'],
        ]);

        Article::published()
            ->orderByDesc('updated_at')
            ->get(['slug', 'source_url', 'updated_at'])
            ->reject(fn (Article $article) => $article->is_external)
            ->each(function (Article $article) use ($urls) {
                $urls->push([
                    'loc' => route('artikel.show', $article),
                    'lastmod' => $article->updated_at,
                    'priority' => '0.7',
                ]);
            });

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
