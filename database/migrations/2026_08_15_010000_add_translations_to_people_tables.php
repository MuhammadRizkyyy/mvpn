<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {
            $table->json('translations')->nullable()->after('position');
        });

        Schema::table('language_class_coordinators', function (Blueprint $table) {
            $table->json('translations')->nullable()->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {
            $table->dropColumn('translations');
        });

        Schema::table('language_class_coordinators', function (Blueprint $table) {
            $table->dropColumn('translations');
        });
    }
};
