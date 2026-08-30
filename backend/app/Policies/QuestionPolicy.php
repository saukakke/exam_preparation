<?php

declare(strict_types=1);

namespace App\Policies;

use App\Domains\Identity\Models\User;
use App\Domains\QuestionBank\Models\Question;

final class QuestionPolicy
{
    public function viewAny(User $user): bool { return $user->can('questions.view'); }
    public function view(User $user, Question $question): bool { return $user->can('questions.view') || $question->author_id === $user->id; }
    public function create(User $user): bool { return $user->can('questions.create'); }
    public function update(User $user, Question $question): bool { return $user->can('questions.update') || $question->author_id === $user->id; }
    public function delete(User $user, Question $question): bool { return $user->can('questions.delete') && $question->status->value !== 'approved'; }
    public function review(User $user): bool { return $user->can('questions.approve'); }
}
