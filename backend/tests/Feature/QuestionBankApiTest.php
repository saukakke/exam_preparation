<?php

declare(strict_types=1);

use App\Domains\Identity\Models\User;
use App\Domains\QuestionBank\Models\QuestionTag;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('requires authentication for question bank endpoints', function (): void {
    $this->getJson('/api/v1/questions')->assertUnauthorized();
    $this->getJson('/api/v1/question-topics')->assertUnauthorized();
    $this->getJson('/api/v1/question-tags')->assertUnauthorized();
});

it('lists question tags for authenticated users', function (): void {
    $user = User::factory()->create();
    QuestionTag::query()->create(['name'=>'Algebra','slug'=>'algebra']);
    $this->actingAs($user)->getJson('/api/v1/question-tags')->assertOk()->assertJsonPath('data.0.slug','algebra');
});
