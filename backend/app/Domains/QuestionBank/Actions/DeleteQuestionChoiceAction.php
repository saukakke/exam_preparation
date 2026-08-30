<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Actions;

use App\Domains\Identity\Models\User;
use App\Domains\QuestionBank\Models\QuestionChoice;
use Illuminate\Validation\ValidationException;

final class DeleteQuestionChoiceAction
{
    public function execute(User $actor, QuestionChoice $choice): void
    {
        $question = $choice->question;
        if ($question->author_id !== $actor->id && ! $actor->can('questions.update')) throw ValidationException::withMessages(['choice'=>'You are not allowed to delete this choice.']);
        if ($question->status->value === 'approved') throw ValidationException::withMessages(['question'=>'Approved questions cannot be modified directly.']);
        $choice->delete();
    }
}
