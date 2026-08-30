<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Actions;

use App\Domains\Identity\Models\User;
use App\Domains\QuestionBank\DTOs\CreateQuestionData;
use App\Domains\QuestionBank\Enums\QuestionStatus;
use App\Domains\QuestionBank\Models\Question;

final class CreateQuestionAction
{
    public function execute(User $author, CreateQuestionData $data): Question
    {
        return Question::query()->create([
            'organization_id' => $author->getAttribute('organization_id'),
            'subject_id' => $data->subjectId,
            'topic_id' => $data->topicId,
            'author_id' => $author->id,
            'type' => $data->type,
            'difficulty' => $data->difficulty,
            'status' => QuestionStatus::Draft,
            'stem' => $data->stem,
            'explanation' => $data->explanation,
            'points' => $data->points,
            'negative_marks' => $data->negativeMarks,
            'metadata' => $data->metadata,
            'version' => 1,
        ]);
    }
}
