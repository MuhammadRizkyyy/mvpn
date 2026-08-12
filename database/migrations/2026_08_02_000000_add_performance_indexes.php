<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->index('category');
            $table->index(['is_published', 'published_at']);
            $table->index('order');
        });

        Schema::table('pengurus', function (Blueprint $table) {
            $table->index(['section', 'order']);
        });

        Schema::table('kegiatans', function (Blueprint $table) {
            $table->index(['category', 'order']);
        });

        Schema::table('mitras', function (Blueprint $table) {
            $table->index(['category', 'order']);
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropIndex(['category']);
            $table->dropIndex(['is_published', 'published_at']);
            $table->dropIndex(['order']);
        });

        Schema::table('pengurus', function (Blueprint $table) {
            $table->dropIndex(['section', 'order']);
        });

        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropIndex(['category', 'order']);
        });

        Schema::table('mitras', function (Blueprint $table) {
            $table->dropIndex(['category', 'order']);
        });
    }
};
