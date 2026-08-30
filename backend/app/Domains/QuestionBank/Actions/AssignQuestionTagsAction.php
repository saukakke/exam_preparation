<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Actions;

use App\Domains\Identity\Models\User;
use App\Domains\QuestionBank\Models\Question;
use Illuminate\Validation\ValidationException;

final class AssignQuestionTagsAction
{
    public function execute(User $actor, Question $question, array $tagIds): Question
    {
        if ($question->author_id !== $actor->id && ! $actor->can('questions.update')) throw ValidationException::withMessages(['question'=>'You are not allowed to modify this question.']);
        if ($question->status->value === 'approved') throw ValidationException::withMessages(['question'=>'Approved questions cannot be modified directly.']);
        $question->tags()->sync($tagIds);
        return $question->load('tags');
    }
}
