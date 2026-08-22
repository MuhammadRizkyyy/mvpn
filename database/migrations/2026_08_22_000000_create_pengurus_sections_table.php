<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Divisi struktur komunitas dulunya konstanta di App\Models\Pengurus.
     * Dipindah ke tabel supaya admin bisa menambah/mengubah sendiri.
     */
    private const LEGACY = [
        'bod' => 'bod',
        'sekretaris' => 'sekretaris_section',
        'ekonomi' => 'ekonomi_section',
        'internasional' => 'internasional_section',
        'kerjasama_id_jerman' => 'kerjasama_id_jerman_section',
        'itdev' => 'itdev_section',
    ];

    public function up(): void
    {
        Schema::create('pengurus_sections', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->unsignedInteger('order')->default(0);
            $table->json('translations')->nullable();
            $table->timestamps();
        });

        $order = 0;

        foreach (self::LEGACY as $slug => $langKey) {
            $translations = [];

            foreach (config('translation.target_locales') as $locale) {
                $translations[$locale] = ['name' => trans("site.struktur.{$langKey}", [], $locale)];
            }

            DB::table('pengurus_sections')->insert([
                'slug' => $slug,
                'name' => trans("site.struktur.{$langKey}", [], 'id'),
                'order' => $order++,
                'translations' => json_encode($translations),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pengurus_sections');
    }
};
