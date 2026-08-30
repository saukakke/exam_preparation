<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Actions;

use App\Domains\Identity\Models\User;
use App\Domains\QuestionBank\Enums\QuestionReviewAction;
use App\Domains\QuestionBank\Enums\QuestionStatus;
use App\Domains\QuestionBank\Models\Question;
use Illuminate\Database\DatabaseManager;
use Illuminate\Validation\ValidationException;

final class SubmitQuestionForReviewAction
{
    public function __construct(private readonly DatabaseManager $db) {}

    public function execute(User $actor, Question $question): Question
    {
        if ($question->author_id !== $actor->id && ! $actor->can('questions.update')) throw ValidationException::withMessages(['question'=>'You are not allowed to submit this question.']);
        if (! in_array($question->status, [QuestionStatus::Draft, QuestionStatus::Rejected], true)) throw ValidationException::withMessages(['question'=>'Only draft or rejected questions can be submitted.']);
        return $this->db->transaction(function () use ($actor,$question): Question {
            $question->update(['status'=>QuestionStatus::InReview]);
            $question->versions()->firstOrCreate(['version'=>$question->version], ['stem'=>$question->stem,'explanation'=>$question->explanation,'snapshot'=>$question->fresh()->toArray(),'created_by'=>$actor->id]);
            $question->reviewHistories()->create(['reviewer_id'=>$actor->id,'action'=>QuestionReviewAction::Submitted]);
            return $question->fresh();
        });
    }
}
