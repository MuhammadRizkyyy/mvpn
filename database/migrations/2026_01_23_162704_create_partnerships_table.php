<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('partnerships', function (Blueprint $table) {
        $table->id();
        $table->string('institution_name');
        $table->string('pic_name');
        $table->string('email');
        $table->text('summary');
        $table->string('proposal_file')->nullable();
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('partnerships');
    }
};
