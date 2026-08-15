<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TranslationService
{
    /**
     * MyMemory's free tier limits each request to roughly 500 bytes of text.
     */
    private const MAX_CHUNK_LENGTH = 450;

    /**
     * Translate a set of fields into each target locale.
     *
     * @param  array<string, string|null>  $fields
     * @param  array<int, string>  $targetLocales
     * @return array<string, array<string, string>>
     */
    public function translateFields(array $fields, array $targetLocales, string $sourceLocale = 'id'): array
    {
        $result = [];

        foreach ($targetLocales as $locale) {
            foreach ($fields as $key => $text) {
                $result[$locale][$key] = $this->translate((string) $text, $locale, $sourceLocale);
            }
        }

        return $result;
    }

    /**
     * Strip HTML down to plain text while keeping the block structure as
     * newlines (list items become bullets), so translated content still
     * renders as separate lines instead of one run-on paragraph.
     */
    public static function htmlToPlain(?string $html): string
    {
        $text = preg_replace('/<li[^>]*>/i', '• ', (string) $html);
        $text = preg_replace('/<\/(li|p|div|h[1-6]|tr)>/i', "\n", $text);
        $text = preg_replace('/<br\s*\/?>/i', "\n", $text);
        $text = html_entity_decode(strip_tags($text), ENT_QUOTES);

        return trim(preg_replace("/\n{3,}/", "\n\n", $text));
    }

    public function translate(string $text, string $targetLocale, string $sourceLocale = 'id'): string
    {
        $text = trim($text);

        if ($text === '' || $targetLocale === $sourceLocale) {
            return $text;
        }

        // Multi-line text is translated line by line so the layout survives.
        if (str_contains($text, "\n")) {
            $lines = array_map(
                fn ($line) => trim($line) === '' ? '' : $this->translate($line, $targetLocale, $sourceLocale),
                explode("\n", $text)
            );

            return implode("\n", $lines);
        }

        $translatedChunks = [];

        foreach ($this->splitIntoChunks($text) as $chunk) {
            $translated = $this->translateChunk($chunk, $sourceLocale, $targetLocale);

            if ($translated === null) {
                // Translation failed — fall back to the original text rather
                // than saving a partially-translated / broken string.
                return $text;
            }

            $translatedChunks[] = $translated;
        }

        return implode(' ', $translatedChunks);
    }

    private function translateChunk(string $text, string $from, string $to): ?string
    {
        try {
            $response = Http::timeout(10)->get('https://api.mymemory.translated.net/get', [
                'q' => $text,
                'langpair' => "{$from}|{$to}",
                'de' => config('services.mymemory.email'),
            ]);

            if (! $response->successful()) {
                Log::warning('MyMemory translation request failed', [
                    'status' => $response->status(),
                    'langpair' => "{$from}|{$to}",
                ]);

                return null;
            }

            $translated = $response->json('responseData.translatedText');

            if (! is_string($translated) || $translated === '' || str_contains(strtolower($translated), 'mymemory warning')) {
                Log::warning('MyMemory translation returned an invalid result', [
                    'langpair' => "{$from}|{$to}",
                    'response' => $response->json(),
                ]);

                return null;
            }

            return html_entity_decode($translated, ENT_QUOTES);
        } catch (\Throwable $e) {
            Log::warning('MyMemory translation request threw an exception', [
                'message' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /**
     * @return array<int, string>
     */
    private function splitIntoChunks(string $text): array
    {
        if (mb_strlen($text) <= self::MAX_CHUNK_LENGTH) {
            return [$text];
        }

        $sentences = preg_split('/(?<=[.!?])\s+/u', $text) ?: [$text];
        $chunks = [];
        $current = '';

        foreach ($sentences as $sentence) {
            if ($current !== '' && mb_strlen($current) + mb_strlen($sentence) + 1 > self::MAX_CHUNK_LENGTH) {
                $chunks[] = $current;
                $current = $sentence;
            } else {
                $current = $current === '' ? $sentence : "{$current} {$sentence}";
            }
        }

        if ($current !== '') {
            $chunks[] = $current;
        }

        return $chunks;
    }
}
