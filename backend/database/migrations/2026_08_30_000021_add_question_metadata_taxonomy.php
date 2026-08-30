<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('questions', function (Blueprint $table): void {
            $table->string('bloom_level', 30)->nullable()->after('difficulty')->index();
            $table->string('source_type', 40)->default('manual')->after('metadata')->index();
            $table->string('source_reference')->nullable()->after('source_type');
        });
        Schema::create('question_tags', function (Blueprint $table): void {
            $table->id(); $table->string('name',100); $table->string('slug',120)->unique(); $table->timestamps();
        });
        Schema::create('question_question_tag', function (Blueprint $table): void {
            $table->foreignId('question_id')->constrained('questions')->cascadeOnDelete();
            $table->foreignId('question_tag_id')->constrained('question_tags')->cascadeOnDelete();
            $table->primary(['question_id','question_tag_id']);
        });
    }
    public function down(): void { Schema::dropIfExists('question_question_tag'); Schema::dropIfExists('question_tags'); Schema::table('questions', fn (Blueprint $table) => $table->dropColumn(['bloom_level','source_type','source_reference'])); }
};
