<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Gallery;
use App\Services\TranslationService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class BackfillContentTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:backfill-content-translations {--force : Re-translate rows that already have translations}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate translations for Article/Gallery rows saved before auto-translate existed';

    public function handle(TranslationService $translator): int
    {
        $targetLocales = config('translation.target_locales');
        $sourceLocale = config('translation.source_locale');

        $this->backfillArticles($translator, $targetLocales, $sourceLocale);
        $this->backfillGalleries($translator, $targetLocales, $sourceLocale);

        Cache::forget('home.articles');
        Cache::forget('home.galleries');

        return self::SUCCESS;
    }

    private function needsTranslation(?array $translations, array $targetLocales): bool
    {
        if ($this->option('force') || blank($translations)) {
            return true;
        }

        foreach ($targetLocales as $locale) {
            if (blank($translations[$locale] ?? null)) {
                return true;
            }
        }

        return false;
    }

    private function backfillArticles(TranslationService $translator, array $targetLocales, string $sourceLocale): void
    {
        $articles = Article::all();
        $this->info("Articles: checking {$articles->count()} rows...");

        foreach ($articles as $article) {
            if (! $this->needsTranslation($article->translations, $targetLocales)) {
                continue;
            }

            $plainContent = html_entity_decode(strip_tags((string) $article->content), ENT_QUOTES);

            $article->translations = $translator->translateFields(
                [
                    'title' => (string) $article->title,
                    'excerpt' => (string) $article->excerpt,
                    'content' => $plainContent,
                ],
                $targetLocales,
                $sourceLocale
            );
            $article->saveQuietly();

            $this->line("  translated article #{$article->id}: {$article->title}");
        }
    }

    private function backfillGalleries(TranslationService $translator, array $targetLocales, string $sourceLocale): void
    {
        $galleries = Gallery::all();
        $this->info("Galleries: checking {$galleries->count()} rows...");

        foreach ($galleries as $gallery) {
            if (! $this->needsTranslation($gallery->translations, $targetLocales)) {
                continue;
            }

            $plainDescription = html_entity_decode(strip_tags((string) $gallery->description), ENT_QUOTES);

            $gallery->translations = $translator->translateFields(
                ['title' => (string) $gallery->title, 'description' => $plainDescription],
                $targetLocales,
                $sourceLocale
            );
            $gallery->saveQuietly();

            $this->line("  translated gallery #{$gallery->id}: {$gallery->title}");
        }
    }
}
