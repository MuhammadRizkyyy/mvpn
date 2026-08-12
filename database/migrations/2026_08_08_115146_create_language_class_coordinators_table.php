<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('language_class_coordinators', function (Blueprint $table) {
            $table->id();
            $table->string('language')->index();
            $table->string('name');
            $table->string('role');
            $table->string('photo')->nullable();
            $table->string('photo_public_id')->nullable();
            $table->string('period')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('language_class_coordinators');
    }
};
