<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Actions;

use App\Domains\Identity\Models\User;
use App\Domains\QuestionBank\Enums\QuestionReviewAction;
use App\Domains\QuestionBank\Enums\QuestionStatus;
use App\Domains\QuestionBank\Models\Question;
use Illuminate\Database\DatabaseManager;
use Illuminate\Validation\ValidationException;

final class ApproveQuestionAction
{
    public function __construct(private readonly DatabaseManager $db) {}
    public function execute(User $reviewer, Question $question, ?string $comment = null): Question
    {
        if (! $reviewer->can('questions.approve')) throw ValidationException::withMessages(['question'=>'You are not authorized to approve questions.']);
        if ($question->status !== QuestionStatus::InReview) throw ValidationException::withMessages(['question'=>'Only questions in review can be approved.']);
        return $this->db->transaction(function () use ($reviewer,$question,$comment): Question {
            $question->update(['status'=>QuestionStatus::Approved]);
            $question->reviewHistories()->create(['reviewer_id'=>$reviewer->id,'action'=>QuestionReviewAction::Approved,'comment'=>$comment]);
            return $question->fresh();
        });
    }
}
