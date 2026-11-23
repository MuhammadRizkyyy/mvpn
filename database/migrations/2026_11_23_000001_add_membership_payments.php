<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::table('memberships', function (Blueprint $t) {
            $t->string('member_number')->nullable()->unique();
            $t->string('membership_state')->default('inactive')->index();
            $t->timestamp('activated_at')->nullable();
            $t->boolean('public_consent')->default(false);
            $t->string('display_name',150)->nullable();
            $t->string('public_bio',160)->nullable();
        });
        Schema::create('membership_payments', function (Blueprint $t) {
            $t->id(); $t->foreignId('membership_id')->constrained()->cascadeOnDelete();
            $t->unsignedBigInteger('amount'); $t->text('instructions');
            $t->string('status')->default('pending'); $t->timestamp('due_at');
            $t->text('proofs')->nullable(); $t->text('note')->nullable(); $t->timestamps();
        });
        Schema::create('membership_events', function (Blueprint $t) {
            $t->id(); $t->foreignId('membership_id')->constrained()->cascadeOnDelete();
            $t->string('action'); $t->text('actor'); $t->text('note')->nullable(); $t->timestamp('created_at');
        });
    }
    public function down(): void {
        Schema::dropIfExists('membership_events'); Schema::dropIfExists('membership_payments');
        Schema::table('memberships', fn(Blueprint $t) => $t->dropColumn(['member_number','membership_state','activated_at','public_consent','display_name','public_bio']));
    }
};
