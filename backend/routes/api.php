<?php

declare(strict_types=1);

use App\Domains\Academics\Http\Controllers\Api\V1\AcademicSessionController;
use App\Domains\Identity\Http\Controllers\Api\V1\AuthController;
use App\Domains\Identity\Http\Controllers\Api\V1\PasswordController;
use App\Domains\Organizations\Http\Controllers\Api\V1\OrganizationController;
use App\Domains\QuestionBank\Http\Controllers\Api\V1\QuestionController;
use App\Domains\QuestionBank\Http\Controllers\Api\V1\QuestionReviewController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::get('/health', fn () => response()->json(['status'=>'ok','service'=>'exam-preparation-api']));
    Route::prefix('auth')->middleware('throttle:api')->group(function (): void {
        Route::post('/register',[AuthController::class,'register']); Route::post('/login',[AuthController::class,'login'])->middleware('throttle:login');
        Route::middleware('auth:sanctum')->group(function (): void { Route::post('/logout',[AuthController::class,'logout']); Route::put('/password',[PasswordController::class,'update']); });
    });
    Route::middleware('auth:sanctum')->group(function (): void {
        Route::post('/organizations',[OrganizationController::class,'store']);
        Route::get('/academic-sessions',[AcademicSessionController::class,'index']); Route::post('/academic-sessions',[AcademicSessionController::class,'store']);
        Route::get('/questions',[QuestionController::class,'index']); Route::post('/questions',[QuestionController::class,'store']);
        Route::post('/questions/{question}/submit-review',[QuestionReviewController::class,'submit']);
        Route::post('/questions/{question}/review',[QuestionReviewController::class,'review']);
    });
});
