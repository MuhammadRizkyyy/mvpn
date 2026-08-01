<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->unsignedInteger('order')->default(0)->after('is_published');
        });

        DB::table('articles')->orderByDesc('published_at')->orderByDesc('id')->get(['id'])
            ->each(function ($article, $index) {
                DB::table('articles')->where('id', $article->id)->update(['order' => $index]);
            });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
