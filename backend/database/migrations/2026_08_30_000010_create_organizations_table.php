<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('organizations', function (Blueprint $table): void {
            $table->id(); $table->string('name', 180); $table->string('slug', 200)->unique();
            $table->string('type', 40)->index(); $table->string('status', 30)->default('pending')->index();
            $table->string('email')->nullable(); $table->string('phone', 30)->nullable(); $table->string('website')->nullable();
            $table->json('settings')->nullable(); $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('organizations'); }
};
