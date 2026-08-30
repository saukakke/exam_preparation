<?php

declare(strict_types=1);

use App\Domains\Identity\Http\Controllers\Api\V1\AuthController;
use App\Domains\Identity\Http\Controllers\Api\V1\PasswordController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::get('/health', fn () => response()->json(['status' => 'ok', 'service' => 'exam-preparation-api']));

    Route::prefix('auth')->middleware('throttle:api')->group(function (): void {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:login');
        Route::middleware('auth:sanctum')->group(function (): void {
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::put('/password', [PasswordController::class, 'update']);
        });
    });
});
