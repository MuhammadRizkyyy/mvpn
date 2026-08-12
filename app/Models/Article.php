<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

class Article extends Model
{
    public const CATEGORIES = [
        'siaran-pers' => 'Siaran Pers',
        'kegiatan' => 'Kegiatan',
        'pengumuman' => 'Pengumuman',
        'opini' => 'Opini',
    ];

    protected $fillable = [
        'category',
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'image_public_id',
        'source_name',
        'source_url',
        'is_published',
        'published_at',
        'order',
        'translations',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'translations' => 'array',
    ];

    protected static function booted(): void
    {
        static::saving(function (Article $article) {
            $base = Str::slug(blank($article->slug) ? $article->title : $article->slug);
            $article->slug = static::uniqueSlug($base, $article->id);

            if ($article->is_published && blank($article->published_at)) {
                $article->published_at = now();
            }
        });

        static::saved(fn () => Cache::forget('home.articles'));
        static::deleted(fn () => Cache::forget('home.articles'));
    }

    protected static function uniqueSlug(string $base, ?int $ignoreId): string
    {
        $slug = $base;
        $suffix = 2;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $suffix++;
        }

        return $slug;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where('published_at', '<=', now());
    }

    public function getIsExternalAttribute(): bool
    {
        return filled($this->source_url);
    }

    public function getUrlAttribute(): string
    {
        return $this->is_external ? $this->source_url : route('artikel.show', $this);
    }

    public function getContentHtmlAttribute(): string
    {
        if (blank($this->content)) {
            return '';
        }

        if ($this->content === strip_tags($this->content)) {
            return nl2br(e($this->content));
        }

        return $this->content;
    }

    public function translated(string $field): string
    {
        $source = (string) ($this->{$field} ?? '');
        $locale = app()->getLocale();

        if ($locale === 'id' || $source === '') {
            return $source;
        }

        $value = $this->translations[$locale][$field] ?? null;

        return filled($value) ? $value : $source;
    }

    /**
     * Plain-text (tag-free) content, translated when the active locale isn't
     * the source locale. Rich formatting/links are only preserved for the
     * source (Indonesian) content — see translatedContentHtml().
     */
    public function translatedContentPlain(): string
    {
        $plain = html_entity_decode(strip_tags((string) $this->content), ENT_QUOTES);
        $locale = app()->getLocale();

        if ($locale === 'id' || $plain === '') {
            return $plain;
        }

        $value = $this->translations[$locale]['content'] ?? null;

        return filled($value) ? $value : $plain;
    }

    public function translatedContentHtml(): string
    {
        if (app()->getLocale() === 'id') {
            return $this->content_html;
        }

        $text = $this->translatedContentPlain();

        return $text === '' ? '' : nl2br(e($text));
    }

    public static function sanitizeContent(?string $html): ?string
    {
        if (blank($html)) {
            return $html;
        }

        $config = (new HtmlSanitizerConfig())
            ->allowElement('p')
            ->allowElement('br')
            ->allowElement('strong')
            ->allowElement('em')
            ->allowElement('u')
            ->allowElement('s')
            ->allowElement('h1')
            ->allowElement('h2')
            ->allowElement('h3')
            ->allowElement('h4')
            ->allowElement('blockquote')
            ->allowElement('ol')
            ->allowElement('ul')
            ->allowElement('li')
            ->allowElement('a', ['href'])
            ->allowLinkSchemes(['http', 'https', 'mailto'])
            ->forceAttribute('a', 'rel', 'noopener noreferrer')
            ->forceAttribute('a', 'target', '_blank');

        return trim((new HtmlSanitizer($config))->sanitize($html));
    }
}
