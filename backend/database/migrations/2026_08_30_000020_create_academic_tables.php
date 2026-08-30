<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('academic_sessions', function (Blueprint $table): void {
            $table->id(); $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('name', 120); $table->date('starts_at'); $table->date('ends_at');
            $table->string('status', 20)->default('draft')->index(); $table->timestamps();
            $table->unique(['organization_id','name']); $table->index(['organization_id','status']);
        });
        Schema::create('subjects', function (Blueprint $table): void {
            $table->id(); $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('name', 150); $table->string('code', 50); $table->text('description')->nullable();
            $table->boolean('is_active')->default(true); $table->timestamps(); $table->unique(['organization_id','code']);
        });
        Schema::create('courses', function (Blueprint $table): void {
            $table->id(); $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('name', 150); $table->string('code', 50); $table->text('description')->nullable();
            $table->boolean('is_active')->default(true); $table->timestamps(); $table->unique(['organization_id','code']);
        });
        Schema::create('course_subject', function (Blueprint $table): void {
            $table->foreignId('course_id')->constrained()->cascadeOnDelete(); $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->primary(['course_id','subject_id']);
        });
        Schema::create('academic_classes', function (Blueprint $table): void {
            $table->id(); $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('name', 120); $table->string('code', 50); $table->string('level', 80)->nullable();
            $table->boolean('is_active')->default(true); $table->timestamps(); $table->unique(['organization_id','code']);
        });
        Schema::create('student_enrollments', function (Blueprint $table): void {
            $table->id(); $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->foreignId('academic_session_id')->constrained('academic_sessions')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete(); $table->foreignId('class_id')->constrained('academic_classes')->cascadeOnDelete();
            $table->string('status', 20)->default('active')->index(); $table->timestamp('enrolled_at')->nullable(); $table->timestamps();
            $table->unique(['academic_session_id','student_id']); $table->index(['organization_id','class_id','status']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('student_enrollments'); Schema::dropIfExists('academic_classes'); Schema::dropIfExists('course_subject'); Schema::dropIfExists('courses'); Schema::dropIfExists('subjects'); Schema::dropIfExists('academic_sessions');
    }
};
