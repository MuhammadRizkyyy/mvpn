<?php

namespace App\Models\Concerns;

/**
 * Untuk model yang punya kolom `translations` (json) hasil auto-translate.
 * Nama orang tidak pernah diterjemahkan — hanya field seperti jabatan.
 */
trait HasAutoTranslations
{
    public function translated(string $field): ?string
    {
        $value = $this->{$field};

        if (app()->getLocale() === config('translation.source_locale') || blank($value)) {
            return $value;
        }

        $translated = $this->translations[app()->getLocale()][$field] ?? null;

        return filled($translated) ? $translated : $value;
    }
}
