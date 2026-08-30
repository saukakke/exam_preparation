<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('branches', function (Blueprint $table): void {
            $table->id(); $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('name', 150); $table->string('code', 50); $table->text('address')->nullable(); $table->boolean('is_active')->default(true); $table->timestamps();
            $table->unique(['organization_id','code']); $table->index(['organization_id','is_active']);
        });
        Schema::create('departments', function (Blueprint $table): void {
            $table->id(); $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('name', 150); $table->string('code', 50); $table->boolean('is_active')->default(true); $table->timestamps();
            $table->unique(['organization_id','code']); $table->index(['organization_id','is_active']);
        });
    }
    public function down(): void { Schema::dropIfExists('departments'); Schema::dropIfExists('branches'); }
};
