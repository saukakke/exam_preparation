<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\DTOs;

use App\Domains\QuestionBank\Enums\QuestionDifficulty;
use App\Domains\QuestionBank\Enums\QuestionType;

final readonly class CreateQuestionData
{
    public function __construct(public int $subjectId, public ?int $topicId, public QuestionType $type, public QuestionDifficulty $difficulty, public string $stem, public ?string $explanation, public float $points, public float $negativeMarks, public array $metadata = []) {}
}
