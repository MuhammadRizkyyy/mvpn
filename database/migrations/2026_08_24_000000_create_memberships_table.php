<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();

            // Step 1 — Data Diri
            $table->string('full_name');
            $table->string('nickname')->nullable();
            $table->string('nik', 16)->unique();
            $table->string('birth_place');
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female']);
            $table->string('whatsapp');
            $table->string('email');
            $table->text('address');
            $table->string('province');
            $table->string('city');
            $table->string('social_media')->nullable();
            $table->string('photo')->nullable();
            $table->string('photo_public_id')->nullable();

            // Step 2 — Latar Belakang
            $table->string('last_education');
            $table->string('education_institution')->nullable();
            $table->string('occupation')->nullable();
            $table->string('company')->nullable();
            $table->string('expertise')->nullable();
            $table->text('organizations')->nullable();
            $table->text('leadership_experience')->nullable();
            $table->text('social_experience')->nullable();
            $table->text('international_experience')->nullable();

            // Step 3 — Motivasi
            $table->text('motivation_reason');
            $table->text('mvpn_knowledge');
            $table->text('contribution');
            $table->text('interest_issue');
            $table->text('vision_youth');

            // Step 4 — Bidang Minat (max 3, validated in controller)
            $table->json('interest_fields');

            // Step 5 — Komitmen
            $table->boolean('agree_statement')->default(false);
            $table->boolean('agree_code_of_conduct')->default(false);
            $table->boolean('agree_participate')->default(false);
            $table->boolean('agree_data_true')->default(false);

            // Step 7 — admin workflow
            $table->enum('status', ['pending', 'verified', 'interview', 'accepted', 'rejected'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
