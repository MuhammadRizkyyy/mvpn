<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->unsignedInteger('order')->default(0)->after('description');
        });

        DB::table('galleries')->orderByDesc('created_at')->orderByDesc('id')->get(['id'])
            ->each(function ($gallery, $index) {
                DB::table('galleries')->where('id', $gallery->id)->update(['order' => $index]);
            });
    }

    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
