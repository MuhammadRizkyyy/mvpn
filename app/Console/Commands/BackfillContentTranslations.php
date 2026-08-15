<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Gallery;
use App\Models\Kegiatan;
use App\Models\LanguageClassCoordinator;
use App\Models\Pengurus;
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
        $this->backfillKegiatans($translator, $targetLocales, $sourceLocale);
        $this->backfillPeople($translator, $targetLocales, $sourceLocale);

        Cache::forget('home.articles');
        Cache::forget('home.galleries');
        Cache::forget('home.kegiatans');
        Cache::forget('home.pengurus');
        Cache::forget('home.language_coordinators');

        return self::SUCCESS;
    }

    /**
     * TranslationService::translate() silently falls back to the source text
     * when the API call fails, and that fallback gets persisted just like a
     * real translation. So a locale bucket that's merely non-blank isn't
     * proof it was actually translated — compare each field against the
     * source text too, since an untouched fallback is byte-identical to it.
     *
     * @param  array<string, string>  $sourceFields
     */
    private function needsTranslation(array $sourceFields, ?array $translations, array $targetLocales): bool
    {
        if ($this->option('force') || blank($translations)) {
            return true;
        }

        foreach ($targetLocales as $locale) {
            if (blank($translations[$locale] ?? null)) {
                return true;
            }

            foreach ($sourceFields as $key => $value) {
                if (trim($value) !== '' && trim((string) ($translations[$locale][$key] ?? '')) === trim($value)) {
                    return true;
                }
            }
        }

        return false;
    }

    private function backfillArticles(TranslationService $translator, array $targetLocales, string $sourceLocale): void
    {
        $articles = Article::all();
        $this->info("Articles: checking {$articles->count()} rows...");

        foreach ($articles as $article) {
            $plainContent = html_entity_decode(strip_tags((string) $article->content), ENT_QUOTES);
            $fields = [
                'title' => (string) $article->title,
                'excerpt' => (string) $article->excerpt,
                'content' => $plainContent,
            ];

            if (! $this->needsTranslation($fields, $article->translations, $targetLocales)) {
                continue;
            }

            $article->translations = $translator->translateFields($fields, $targetLocales, $sourceLocale);
            $article->saveQuietly();

            $this->line("  translated article #{$article->id}: {$article->title}");
        }
    }

    private function backfillGalleries(TranslationService $translator, array $targetLocales, string $sourceLocale): void
    {
        $galleries = Gallery::all();
        $this->info("Galleries: checking {$galleries->count()} rows...");

        foreach ($galleries as $gallery) {
            $plainDescription = html_entity_decode(strip_tags((string) $gallery->description), ENT_QUOTES);
            $fields = ['title' => (string) $gallery->title, 'description' => $plainDescription];

            if (! $this->needsTranslation($fields, $gallery->translations, $targetLocales)) {
                continue;
            }

            $gallery->translations = $translator->translateFields($fields, $targetLocales, $sourceLocale);
            $gallery->saveQuietly();

            $this->line("  translated gallery #{$gallery->id}: {$gallery->title}");
        }
    }

    private function backfillKegiatans(TranslationService $translator, array $targetLocales, string $sourceLocale): void
    {
        $kegiatans = Kegiatan::all();
        $this->info("Kegiatans: checking {$kegiatans->count()} rows...");

        foreach ($kegiatans as $kegiatan) {
            $fields = [
                'title' => (string) $kegiatan->title,
                'description' => TranslationService::htmlToPlain($kegiatan->description),
            ];

            if (! $this->needsTranslation($fields, $kegiatan->translations, $targetLocales)) {
                continue;
            }

            $kegiatan->translations = $translator->translateFields($fields, $targetLocales, $sourceLocale);
            $kegiatan->saveQuietly();

            $this->line("  translated kegiatan #{$kegiatan->id}: {$kegiatan->title}");
        }
    }

    /**
     * Jabatan pengurus & PJ kelas bahasa. Nama orang tidak diterjemahkan.
     */
    private function backfillPeople(TranslationService $translator, array $targetLocales, string $sourceLocale): void
    {
        $rows = Pengurus::all()->map(fn ($p) => [$p, 'position'])
            ->concat(LanguageClassCoordinator::all()->map(fn ($p) => [$p, 'role']));

        $this->info("People: checking {$rows->count()} rows...");

        foreach ($rows as [$row, $field]) {
            $fields = [$field => (string) $row->{$field}];

            if (! $this->needsTranslation($fields, $row->translations, $targetLocales)) {
                continue;
            }

            $row->translations = $translator->translateFields($fields, $targetLocales, $sourceLocale);
            $row->saveQuietly();

            $this->line("  translated {$row->name}: {$row->{$field}}");
        }
    }
}
