<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tab Program Kerja dulunya konstanta di App\Models\Kegiatan plus markup
     * hardcoded di landing page. Dipindah ke tabel supaya admin bisa
     * menambah/mengubah tab sendiri.
     */
    private const LEGACY = [
        ['slug' => 'pendidikan', 'icon' => 'bi-mortarboard-fill', 'pills' => true],
        ['slug' => 'wirausaha', 'icon' => 'bi-graph-up-arrow', 'pills' => false],
        ['slug' => 'sdm', 'icon' => 'bi-people-fill', 'pills' => false],
    ];

    public function up(): void
    {
        Schema::create('kegiatan_categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('icon')->default('bi-stars');
            $table->text('description')->nullable();
            $table->boolean('show_language_pills')->default(false);
            $table->unsignedInteger('order')->default(0);
            $table->json('translations')->nullable();
            $table->timestamps();
        });

        $order = 0;

        foreach (self::LEGACY as $legacy) {
            $slug = $legacy['slug'];
            $translations = [];

            foreach (config('translation.target_locales') as $locale) {
                $translations[$locale] = [
                    'name' => trans("site.proker.tab_{$slug}", [], $locale),
                    'description' => trans("site.proker.card_{$slug}_desc", [], $locale),
                ];
            }

            DB::table('kegiatan_categories')->insert([
                'slug' => $slug,
                'name' => trans("site.proker.tab_{$slug}", [], 'id'),
                'icon' => $legacy['icon'],
                'description' => trans("site.proker.card_{$slug}_desc", [], 'id'),
                'show_language_pills' => $legacy['pills'],
                'order' => $order++,
                'translations' => json_encode($translations),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan_categories');
    }
};
