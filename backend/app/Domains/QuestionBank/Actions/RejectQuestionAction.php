<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Actions;

use App\Domains\Identity\Models\User;
use App\Domains\QuestionBank\Enums\QuestionReviewAction;
use App\Domains\QuestionBank\Enums\QuestionStatus;
use App\Domains\QuestionBank\Models\Question;
use Illuminate\Database\DatabaseManager;
use Illuminate\Validation\ValidationException;

final class RejectQuestionAction
{
    public function __construct(private readonly DatabaseManager $db) {}
    public function execute(User $reviewer, Question $question, string $comment): Question
    {
        if (! $reviewer->can('questions.approve')) throw ValidationException::withMessages(['question'=>'You are not authorized to review questions.']);
        if ($question->status !== QuestionStatus::InReview) throw ValidationException::withMessages(['question'=>'Only questions in review can be rejected.']);
        return $this->db->transaction(function () use ($reviewer,$question,$comment): Question {
            $question->update(['status'=>QuestionStatus::Rejected]);
            $question->reviewHistories()->create(['reviewer_id'=>$reviewer->id,'action'=>QuestionReviewAction::Rejected,'comment'=>$comment]);
            return $question->fresh();
        });
    }
}
