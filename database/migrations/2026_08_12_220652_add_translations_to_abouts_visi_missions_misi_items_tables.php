<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->json('translations')->nullable()->after('paragraph_3');
        });

        Schema::table('visi_missions', function (Blueprint $table) {
            $table->json('translations')->nullable()->after('visi_text');
        });

        Schema::table('misi_items', function (Blueprint $table) {
            $table->json('translations')->nullable()->after('text');
        });
    }

    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->dropColumn('translations');
        });

        Schema::table('visi_missions', function (Blueprint $table) {
            $table->dropColumn('translations');
        });

        Schema::table('misi_items', function (Blueprint $table) {
            $table->dropColumn('translations');
        });
    }
};
