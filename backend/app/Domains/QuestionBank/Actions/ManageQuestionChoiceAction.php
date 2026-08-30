<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Actions;

use App\Domains\Identity\Models\User;
use App\Domains\QuestionBank\Models\Question;
use App\Domains\QuestionBank\Models\QuestionChoice;
use Illuminate\Database\DatabaseManager;
use Illuminate\Validation\ValidationException;

final class ManageQuestionChoiceAction
{
    public function __construct(private readonly DatabaseManager $db) {}
    public function create(User $actor, Question $question, array $data): QuestionChoice
    {
        if ($question->author_id !== $actor->id && ! $actor->can('questions.update')) throw ValidationException::withMessages(['question'=>'You are not allowed to modify this question.']);
        return $this->db->transaction(fn () => $question->choices()->create($data));
    }
}
