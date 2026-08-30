<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('question_topics', function (Blueprint $table): void {
            $table->id(); $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete(); $table->foreignId('parent_id')->nullable()->constrained('question_topics')->cascadeOnDelete();
            $table->string('name',150); $table->string('slug',180); $table->text('description')->nullable(); $table->timestamps(); $table->unique(['subject_id','slug']); $table->index(['subject_id','parent_id']);
        });
        Schema::create('questions', function (Blueprint $table): void {
            $table->id(); $table->foreignId('organization_id')->nullable()->constrained()->nullOnDelete(); $table->foreignId('subject_id')->constrained('subjects')->restrictOnDelete(); $table->foreignId('topic_id')->nullable()->constrained('question_topics')->nullOnDelete(); $table->foreignId('author_id')->constrained('users')->restrictOnDelete();
            $table->string('type',40)->index(); $table->string('difficulty',30)->index(); $table->string('status',30)->default('draft')->index(); $table->longText('stem'); $table->longText('explanation')->nullable(); $table->decimal('points',8,2)->default(1); $table->decimal('negative_marks',8,2)->default(0); $table->json('metadata')->nullable(); $table->unsignedInteger('version')->default(1); $table->timestamps(); $table->index(['organization_id','status']); $table->index(['subject_id','topic_id','difficulty']);
        });
        Schema::create('question_choices', function (Blueprint $table): void {
            $table->id(); $table->foreignId('question_id')->constrained()->cascadeOnDelete(); $table->longText('content'); $table->boolean('is_correct')->default(false); $table->unsignedInteger('position'); $table->json('metadata')->nullable(); $table->timestamps(); $table->unique(['question_id','position']);
        });
        Schema::create('question_versions', function (Blueprint $table): void {
            $table->id(); $table->foreignId('question_id')->constrained()->cascadeOnDelete(); $table->unsignedInteger('version'); $table->longText('stem'); $table->longText('explanation')->nullable(); $table->json('snapshot'); $table->foreignId('created_by')->constrained('users')->restrictOnDelete(); $table->timestamps(); $table->unique(['question_id','version']);
        });
    }
    public function down(): void { Schema::dropIfExists('question_versions'); Schema::dropIfExists('question_choices'); Schema::dropIfExists('questions'); Schema::dropIfExists('question_topics'); }
};
